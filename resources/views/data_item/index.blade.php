@extends('welcome')
@section('content')

<div class="">
    <a href="{{route('data_item.create')}}" class="btn btn-primary" style="float: left;" name="button">Tambah</a>
</div>
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($item as $data)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$data->i_name}}</td>
            <td>{{number_format($data->i_price,2,',','.')}}</td>
            <td>
                <form action="{{route('data_item.destroy',$data->i_id)}}" method="post">
                    <a href="{{route('data_item.edit',$data->i_id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="botttom" title="Detail Data" style="color:white;">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are You Sure?')" class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Hapus Data" style="color:white;">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
