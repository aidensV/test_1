@extends('welcome')
@section('content')

<form action="{{route('data_item.store')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Nama</label>
        <input type="text" name="i_name" class="form-control" placeholder="Nama">
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
              <label for="exampleInputEmail1">Satuan</label>
            <select class="form-control" name="i_unit1">
                @foreach ($unit as $data)
                <option value="{{$data->u_id}}">{{$data->u_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Jumlah</label>
            <input type="text" name="i_unitcompare_1" class="form-control" id="inputPassword4" >
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <select class="form-control" name="i_unit2">
                @foreach ($unit as $data)
                <option value="{{$data->u_id}}">{{$data->u_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" name="i_unitcompare_2" id="inputPassword4" >
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <select class="form-control" name="i_unit3">
                @foreach ($unit as $data)
                <option value="{{$data->u_id}}">{{$data->u_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control" name="i_unitcompare_3" id="inputPassword4" >
        </div>
    </div>


    <div class="form-group">
        <label for="exampleInputEmail1">Harga</label>
        <input type="text" name="i_price" class="form-control" placeholder="Nama">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form  >
@endsection
