@extends('welcome')
@section('content')

<div class="">

    <a href="{{route('data_owner.create')}}" class="btn btn-primary" style="float: left;" name="button">Tambah</a>
</div>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Address</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($owner as $data)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$data->o_name}}</td>
            <td>{{$data->o_address}}</td>
            <td>
                <form action="{{route('data_owner.destroy',$data->o_id)}}" method="post">
                    <a href="{{route('data_owner.edit',$data->o_id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="botttom" title="Detail Data" style="color:white;">Edit</a>
                    {{csrf_field()}}
                    {{method_field("DELETE")}}
                    <button type="submit" onclick="return confirm('Are You Sure?')" class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Hapus Data" style="color:white;">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
