@extends('welcome')
@section('content')
<form action="{{route('data_owner.update',$owner->o_id)}}" method="post">
    @csrf
    {{method_field('PUT')}}
    <div class="form-group">
        <label for="exampleInputEmail1">Nama</label>
        <input type="text" name="o_name" class="form-control" value="{{$owner->o_name}}" placeholder="Nama">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Address</label>
        <input type="text" name="o_address" value="{{$owner->o_address}}" class="form-control" placeholder="Address">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
