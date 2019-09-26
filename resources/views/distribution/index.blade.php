@extends('welcome')
@section('content')

<div class="">

    {{-- <a href="{{route('data_owner.create')}}" class="btn btn-primary" style="float: left;" name="button">Tambah</a> --}}
</div>

<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Date</th>
            <th>Owner</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dist as $data)

        <tr>
            <td>{{$no++}}</td>
            <td>{{$data->date}}</td>
            <td>{{$data->o_name}}</td>
            <td>

                <form action="{{route('distribution.destroy',$data->id)}}" method="post">
                    @csrf {{method_field('DELETE')}}
                    <a href="{{route('distribution.edit',$data->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="botttom" title="Detail Data" style="color:white; margin:10px">Detail</a>
                    <button type="submit" onclick="return confirm('Are You Sure?')" class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Detail Data" style="color:white;" name="button">Delete</button>
                    {{-- <a class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Detail Data" style="color:white;">Delete</a> --}}
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
