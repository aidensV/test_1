@extends('welcome')
@section('content')

<section class="content">
  <div class="row">


    <div class="col-md-12">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body" id="div_top">
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
                    <th>Satuan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                  <tr class="footernull">
                    <td colspan="6" align="center">Tidak Ada Data</td>
                  </tr>
                  <tr class="footercount" style="display: none;">
                    <td  colspan="4" align="center" ></td>
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
@include('order.form')
@endsection
@section('js')
<!-- DataTables -->
<script src="{{asset('js/accounting.js')}}" charset="utf-8"></script>
<script type="text/javascript">
function cek_barang() {
  u_id=$('.form_barang select[name=u_id]').val();
  b_id=$('.form_barang select[name=id_barang]').val();
   return axios.get('{{ url('cek_item') }}'+ '/' + b_id + '/' + u_id);
}
// save Data
function saveToDatabase() {
  var form = $('#form-table');
  var data = form.serialize();
  $.ajaxSetup ({
          cache: false
      });
  axios({
  method: 'post',
  url: "{{route('order.store')}}",
  headers: {},
  data: data,
});
location.reload(true);
}

  var formBarang = $(".form_barang");
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
        placeholder: 'Pilih Owner Tujuan',
        language: "id"
      });
      $('#u_id').select2({
        dropdownParent: $("#modal-form"),
        placeholder: 'Pilih Satuan Barang',
        language: "id"
      });

      $(document).ready(function(){
          $('select[name="o_id"]').on('change', function() {
              var provID = $(this).val();
              if(provID) {
                  $.ajax({
                      url: "{{url('get_data_barang')}}"+'/'+provID,
                      type: "GET",
                      dataType: "json",
                      success:function(data) {
                          $('select[name="id_barang"]').empty();
                          $.each(data, function(key, value) {
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
                      url: "{{url('get_unit_barang')}}"+'/'+provID,
                      type: "GET",
                      dataType: "json",
                      success:function(data) {
                          $('select[name="u_id"]').empty();
                          $.each(data, function(key, value) {
                              $('select[name="u_id"]').append('<option value="'+ value.u_id +'">'+ value.u_name +'</option>');
                          });
                      }
                  });
              }else{
                  $('select[name="id_barang"]').empty();
              }
          });
      });
    });

    // Select2 js Chained
    $(document).on("click",".btn_tambah",function(e){
      $('.form_barang')[0].reset();
      $('.form_barang select').val([]).change();
      $('.form_barang input[name=crud]').val("tambah");
      $('.form_barang input[type=number]').val(0).keyup();
      $('#modal-form').modal('show');
      rowtempx=null;
    });

    $(document).on("submit",".form_barang",function(e){
      var crud = $('.form_barang input[name=crud]').val();
      var id_barang = $('.form_barang select[name=id_barang]').val();
      var nama_barang = $('.form_barang select[name=id_barang] option:selected').text();
      var nama_satuan = $('.form_barang select[name=u_id] option:selected').text();
      var jumlah = $('.form_barang input[name=jumlah]').val();
      var satuan = $('.form_barang select[name=u_id]').val();
      var id_owner_to = $('.form_barang select[name=o_id]').val();
      var id_owner_from = "{{Auth::user()->owner_id}}";

      var attr=" nama_barang='"+nama_barang+"' id_barang='"+id_barang+"' satuan='"+satuan+"' jumlah='"+jumlah+"'  o_id='"+id_owner_to+"' ";
      var row=""+
      "<td>"+nama_barang+"<input type='hidden' readonly='' value='"+id_barang+"' name='id_barang[]' ><input type='hidden' readonly='' value='"+satuan+"' name='satuan[]' > <input type='hidden' readonly='' value='"+id_owner_to+"' name='o_id[]' ></td>"+
      "<td class='text-right'><input type='' readonly value='"+accounting.formatNumber(jumlah)+"' class='text-right' name='jumlah[]' style='background:none;border:0;'></td>"+
      "<td class='text-right'><input type='' readonly value='"+nama_satuan+"' class='text-right' name='' style='background:none;border:0;'></td>"+
      "<td><a class='btn btn-danger btn-xs btn_del' data-id='2' style='color:white'>Hapus</a></td>";

    if(crud=="tambah"){
      $('table.table-barang tbody').append("<tr id='"+ id_barang +" 'to='"+id_owner_to+" 'from='"+id_owner_from+" ' qty='"+ jumlah +"'>"+row+"</tr>");
     }

    $('#modal-form').modal('hide');
    rowtempx=null;
    reload_table();
  });

    //auto
    $(document).on("change",".form_barang select[name=barang_harga]",function(e){
      totalCountBarang();
    });

    $(document).on("click"," .btn_del",function(e){
      var id_barang_del = $(this).parents('tr:first').attr('id');
      var qty_del = $(this).parents('tr:first').attr('qty');
      var id_owner_to = $(this).parents('tr:first').attr('to');
      var id_owner_from = $(this).parents('tr:first').attr('from');
      // Kurangi Stock
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
