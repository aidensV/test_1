@extends('welcome')
@section('content')
<form action="{{route('data_item.update',$item->i_id)}}" method="post">
    @csrf @method('PUT')
    <div class="form-group">
        <label for="exampleInputEmail1">Nama</label>
        <input type="text" name="i_name" value="{{$item->i_name}}" class="form-control" placeholder="Nama">
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
              <label for="exampleInputEmail1">Satuan</label>
            <select class="form-control" name="i_unit1">
                @foreach ($unit as $data)
                  @if ($item->i_unit1 == $data->u_id)
                    <option selected value="{{$data->u_id}}">{{$data->u_name}}</option>
                  @else
                    <option  value="{{$data->u_id}}">{{$data->u_name}}</option>
                  @endif
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Jumlah</label>
            <input type="text" name="i_unitcompare_1" value="{{$item->i_unitcompare1}}" class="form-control"  >
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <select class="form-control" name="i_unit2">
              @foreach ($unit as $data)
                @if ($data->u_id == $item->i_unit2)
                <option selected value="{{$data->u_id}}">{{$data->u_name}}</option>
              @else
                <option  value="{{$data->u_id}}">{{$data->u_name}}</option>
              @endif
              @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" name="i_unitcompare_2" value="{{$item->i_unitcompare2}}" >
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <select class="form-control" name="i_unit3">
              @foreach ($unit as $data)
                @if ($data->u_id == $item->i_unit3)
                <option selected value="{{$data->u_id}}">{{$data->u_name}}</option>
              @else
                <option  value="{{$data->u_id}}">{{$data->u_name}}</option>
              @endif
              @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" name="i_unitcompare_3" value="{{$item->i_unitcompare1}}" >
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Harga</label>
        <input type="text" name="i_price" class="form-control" value="{{$item->i_price}}" placeholder="Rp.900.00">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
