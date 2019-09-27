@extends('welcome')
@section('content')
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
                <form action="{{route('order.destroy',$data->id)}}" method="post">
                    @csrf {{method_field('DELETE')}}
                    <a href="{{route('order.edit',$data->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="botttom" title="Detail Data" style="color:white;">Detail</a>
                    <button type="submit" onclick="return confirm('Are You Sure?')" class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Detail Data" style="color:white;" name="button">Delete</button>

                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
