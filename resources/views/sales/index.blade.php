@extends('welcome')
@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
          <form id="form-table" role="form" class="form_belanja"  method="post">
              {{ csrf_field() }} {{ method_field('POST') }}
            <div class="box-body">
              <div class="form-group col-md-12" style="border:1px solid black;">
               <h3>Detail Barang</h3>
               <hr/>
               <a href="javascript:;" class=" btn btn-sm btn-success btn_tambah" > Tambah Barang</a>
               <br/> <br/>
               <table class="table table-bordered table-hover table-striped  table-barang" style="width:100px;">
                <thead>
                  <tr>
                    <th>Nama Item</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Sub Total</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <tr class="footernull">
                    <td colspan="6" align="center">Tidak Ada Data</td>
                  </tr>
                  <tr class="footercount" style="display: none;">
                    <td  colspan="4" align="center" ></td>
                    <td  align="right" class="total"></td>
                  </tr>
                </tfoot>
              </table>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="" class="btn btn-md btn-warning">Reset</a>
          <button type="button" onclick="saveToDatabase()" class="btn bg-blue btn-md pull-right"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
        </div>
      </form>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
<!-- /.row (main row) -->
</section>

<!-- /.content -->
@include('sales.create')
@endsection
@section('js')
<script src="{{asset('js/accounting.js')}}" charset="utf-8"></script>
<script type="text/javascript">
function cek_barang() {
  u_id=$('.form_barang select[name=u_id]').val();
  b_id=$('.form_barang select[name=id_barang]').val();
   return axios.get('{{ url('cek_item') }}'+ '/' + b_id + '/' + u_id);
}

// Cek Qty Ajax
function cekQty(qty){
  var id_item = $("#id_barang").val();
  let id_owner = "{{Auth::user()->owner_id}}";

cek_barang().then(function (data) {
  axios({
  method: 'get',
  url: 'cek_qty/'+id_item+'/'+id_owner,
  responseType: 'stream'
  })
  .then(function (response) {
    let val_unit = data.data;
    var qty_total = qty * val_unit;

    if (qty_total <= (response.data)) {
      document.getElementById("btn_simpan").disabled = false;
      $("#message_qty").html("");
    }else{
      $("#message_qty").html("Stok Tersedia : <b style='color:black'>"+response.data+"</b>");
      document.getElementById("btn_simpan").disabled = true;
    }
  });
});

}
// save Data
function saveToDatabase() {
  var form = $('#form-table');
  var data = form.serialize();
  axios({
  method: 'post',
  url: "{{route('sales.store')}}",
  headers: {},
  data: data,
});

location.reload(true);
}
var formBarang = $(".form_barang");

  var formBelanja = $(".form_belanja");
  var selectPajak = formBelanja.find("select[name=pajak]");
  var inputOngkir = formBelanja.find("input[name=status_ongkir]");
  var inputNominalOngkir = formBelanja.find("input[name=nominal_ongkir]");

  $(function () {
    accounting.settings = {
          currency: {
                  symbol: "",
                  precision: 2,
                  thousand: ".",
                  decimal : ",",
                  format: {
                      pos : '%s %v',
                      neg : '%s (%v)',
                      zero : '%s %v'
                  },
          },
          number: {
            precision : 0,  // default precision on numbers is 0
            thousand: ".",
            decimal : ","
          }
    };

    var rowtempx=null;
// Initial Select 2 js
    $(document).ready(function() {
      $("#id_barang").select2({
        dropdownParent: $("#modal-form"),
        placeholder: 'Pilih Nama Barang',
        language: "id"
      });

      $('#o_id').select2({
        dropdownParent: $("#modal-form"),
        placeholder: 'Pilih Nama Owner',
        language: "id"
      });
    });

    // Select2 js Chained
    $(document).ready(function()
    {
        $('select[name="o_id"]').on('change', function() {
            var provID = $(this).val();
            if(provID) {
                $.ajax({
                    url: 'get_data_barang/'+provID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="id_barang"]').empty();
                        $.each(data, function(key, value) {
                          // console.log(value.s_id_owner);
                            $('select[name="id_barang"]').append('<option value="'+ value.i_id +'">'+ value.i_name +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="id_barang"]').empty();
            }
        });
    });

    $(document).ready(function(){
        $('select[name="id_barang"]').on('change', function() {
            var provID = $(this).val();
            if(provID) {
                $.ajax({
                    url: 'get_unit_barang/'+provID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      // console.log(data);
                        $('select[name="u_id"]').empty();
                        $.each(data, function(key, value) {
                          // console.log(value.s_id_owner);
                            $('select[name="u_id"]').append('<option value="'+ value.u_id +'">'+ value.u_name +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="id_barang"]').empty();
            }
        });
    });
    //
    $('#id_barang').on('change', function(e){
        var state_id = e.target.value;
        $.get('{{ url('get_harga_barang') }}'+ '/' + state_id, function(data) {
            $('#barang_harga').empty();
                $('#barang_harga').val(''+data+'');
        });
    });

    $(document).on("click",".btn_tambah",function(e){
      $('.form_barang')[0].reset();
      $('.form_barang select').val([]).change();
      $('.form_barang input[name=crud]').val("tambah");
      $('.form_barang input[type=number]').val(0).keyup();
      $('#modal-form').modal('show');
      rowtempx=null;
    });

    $(document).on("click",".btn_edit",function(e){
      $('.form_barang')[0].reset();
      $('.form_barang select').val([]).change();
      $('.form_barang input[name=crud]').val("edit");
      var id_barang=$(this).attr('id_barang');
      var barang_harga=$(this).attr('barang_harga');
      var total=$(this).attr('total');
      var jumlah=$(this).attr('jumlah');
      $('.form_barang select[name=id_barang]').val(id_barang).change();
      $('.form_barang select[name=barang_harga]').val(barang_harga).change();
      $('.form_barang input[name=jumlah]').val(jumlah).keyup();
      rowtempx=$(this).parents('tr');
      showModal("#modal-form");
    });

    $(document).on("submit",".form_barang",function(e){
      var crud = $('.form_barang input[name=crud]').val();
      var id_barang = $('.form_barang select[name=id_barang]').val();
      var nama_barang = $('.form_barang select[name=id_barang] option:selected').text();
      var barang_harga = $('.form_barang input[name=barang_harga]').val();
      var jumlah = $('.form_barang input[name=jumlah]').val();
      var total = $('.form_barang input[name=total]').val();
      var id_owner = $('.form_barang select[name=o_id]').val();
      var unit_id = $('.form_barang select[name=u_id]').val();

      // kurangi stok
      cek_barang().then(function(response){
        let qty = jumlah * response.data;
        axios({
        method: 'post',
        url: 'kurangi_stock',
        data: {
          id_barang: id_barang,
          qty: qty,
          id_owner: id_owner
          }
        });
      });
      var attr=" nama_barang='"+nama_barang+"' id_barang='"+id_barang+"' total='"+total+"' jumlah='"+jumlah+"'  barang_harga='"+barang_harga+"' ";
      var row=""+
      "<td>"+nama_barang+"<input type='hidden' readonly='' value='"+id_barang+"' name='id_barang[]' ><input type='hidden' readonly='' value='"+barang_harga+"' name='barang_harga[]' ><input type='hidden' readonly='' value='"+total+"' name='tot[]' ><input type='hidden' readonly='' value='"+unit_id+"' name='unit_id[]' ></td>"+
      "<td class='text-right'><input type='' readonly value='"+accounting.formatNumber(jumlah)+"' class='text-right' name='jumlah[]' style='background:none;border:0;'></td>"+
      "<td class='text-right'><input type='' readonly value='"+accounting.formatMoney(barang_harga)+"' class='text-right' name='' style='background:none;border:0;'></td>"+
      "<td class='text-right'><input type='' readonly value='"+accounting.formatMoney(total)+"' class='text-right'  style='background:none;border:0;'></td>"+
      "<td><a class='btn btn-danger btn-xs btn_del' data-id='2' style='color:white'>Hapus</a></td>";

    if(crud=="tambah"){
      $('table.table-barang tbody').append("<tr id='"+ id_barang +" ' qty='"+ jumlah +" ' id_owner='"+ id_owner +"'>"+row+"</tr>");
     }

    $('#modal-form').modal('hide');
    rowtempx=null;
    reload_table();

  });
    //aut
    $(document).on("keyup",".form_barang input[name=jumlah]",function(e){
      totalCountBarang();
    });
    $(document).on("change",".form_barang select[name=barang_harga]",function(e){
      totalCountBarang();
    });

    $(document).on("click"," .btn_del",function(e){
      var id_barang_del = $(this).parents('tr:first').attr('id');
      var qty_del = $(this).parents('tr:first').attr('qty');
      var id_owner = $(this).parents('tr:first').attr('id_owner');
      axios({
        method: 'get',
        url: '{{ url('cek_item') }}'+ '/' + b_id + '/' + u_id,
        responseType: 'stream'
      }).then(function (response) {
          let qty = qty_del * response.data;
          axios({
          method: 'post',
          url: 'tambahi_stock',
          data: {
            id_barang: id_barang_del,
            qty: qty,
            id_owner:id_owner
            }
          });

        });
        $(this).parents('tr').remove();
        reload_table();
    });

    function reload_table(){
      var rowbarang = $('table.table-barang > tbody > tr').length;
      var xbarang = 0;
      var detail_id =0;
      $('.table-barang input[name="tot[]"]').each(function() {
      xbarang+=parseFloat(accounting.unformat($(this).val(),","));
      });
      var details_id=$(".form_barang input[name=detail_id]").val();
      $('table.table-barang  tfoot tr.footercount .total ').html(accounting.formatMoney(xbarang));
      $('.form_barang select[name=id_barang]').val(id_barang).change();
      if(rowbarang>0){
        $('table.table-barang  tfoot tr.footernull ').hide();
        $('table.table-barang  tfoot tr.footercount ').show();
      }else{
        $('table.table-barang  tfoot tr.footernull ').show();
        $('table.table-barang  tfoot tr.footercount ').hide();
      }
  }

  function setFormatMoney(this_)
  {
    var nilai = this_.val();
    var helpBlock = this_.parent('div').find(".fmt-nominal");
    helpBlock.html(accounting.formatMoney(nilai));
  }

  function setFormatThous(this_) {
    var nilai = this_.val();
    var helpBlock = this_.parent('div').find(".fmt-nominal");
    helpBlock.html(accounting.formatNumber(nilai));
  }

  function totalCountBarang() {
    harga_satuan=parseInt($(".form_barang input[name=barang_harga]").val());
    jumlah=parseInt($(".form_barang input[name=jumlah]").val());
    u_id=$('.form_barang select[name=u_id]').val();
    b_id=$('.form_barang select[name=id_barang]').val();

    cek_barang().then(function (data){
      let val_unit = data.data;
      $(".form_barang input[name=total]").val((jumlah * val_unit) * harga_satuan).keyup();
    });

  }
});
</script>

@endsection
