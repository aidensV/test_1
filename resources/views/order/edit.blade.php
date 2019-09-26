@extends('welcome')
@section('content')

            <div class="">

                {{-- <a href="{{route('data_owner.create')}}" class="btn btn-primary" style="float: left;" name="button">Tambah</a> --}}
            </div>
            <form id="form-table" class="" method="post">

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Stock</th>
                        <th>qty</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dist as $data)

                    <tr id="{{$data->id}}" dt="{{$data->detail_id}}">
                        <td>{{$no++}}</td>
                        <td>{{$data->i_name}}</td>
                        <td>{{$data->s_qty}}</td>
                        <td width="20%"> <input type="hidden" name="detail_id[]" value="{{$data->detail_id}}">
                          <input type="hidden" name="id_dst[]" value="{{$data->id}}">
                          <input type="hidden" name="item_id[]" value="{{$data->item_id}}">
                          <input type="hidden" name="from[]" value="{{$data->from}}">
                          <input id="qty" style=" text-align: center;background-color:hsla(120,60%,100%,0.1);" type="text" name="qty[]" class="form-control" value="{{$data->qty}}"></td>
                        <td>
                          <select class="form-control" name="unit[]" >
                              @foreach ($unit as $value)
                                @if ($value->u_id == $data->unit)
                                <option selected value="{{$value->u_id}}">{{$value->u_name}}</option>
                              @else
                                <option  value="{{$value->u_id}}">{{$value->u_name}}</option>
                              @endif
                              @endforeach
                          </select>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>

            <button type="button" onclick="saveToDatabase()" class="btn btn-success" name="button">Simpan</button>
          </form>

          @endsection

@section('js')
  <script type="text/javascript">

  function saveToDatabase() {

    var form = $('#form-table');
    var data = form.serialize();
    $.ajaxSetup ({
            cache: false
        });
  // var total = $('.form_barang input[name=total]').val();
    axios({
    method: 'post',
    url: "{{route('update_status_order')}}",
    headers: {},
    data: data,
  })
  .then(function (response) {
  window.location ="{{url('order')}}";
      // console.log(response);
    })
    .catch(function (error) {
      console.log(error);
    });

  }

  $(document).ready(function(){
    $("input:text").change(function() {
      var id_stock = $(this).closest('tr').attr('id');
      var id_dt = $(this).closest('tr').attr('dt');
      var lv_input = document.getElementById("example").rows[0];
      var qty = $("#qty").val();

      axios.post("{{route('update_qty')}}", {
          dst_id: id_stock,
          dt_id: id_dt,
          qty: qty
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
      });
  });

  $(document).ready(function(){
    $("select").change(function() {
      var id_stock = $(this).closest('tr').attr('id');
      var id_dt = $(this).closest('tr').attr('dt');
      var unit = $(this).val();

      axios.post("{{route('update_unit')}}", {
          dst_id: id_stock,
          dt_id: id_dt,
          unit: unit
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
      });
  });
  </script>
@endsection
