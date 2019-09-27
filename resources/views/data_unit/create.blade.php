@extends('welcome')
@section('content')
<form action="{{route('data_unit.store')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Nama</label>
        <input type="text" name="u_name" class="form-control" placeholder="Nama">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
