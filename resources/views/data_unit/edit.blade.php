@extends('welcome')
@section('content')

<form action="{{route('data_unit.update',$unit->u_id)}}" method="post">
    @csrf
    {{method_field('PUT')}}
    <div class="form-group">
        <label for="exampleInputEmail1">Nama</label>
        <input type="text" name="u_name" class="form-control" value="{{$unit->u_name}}" placeholder="Nama">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
