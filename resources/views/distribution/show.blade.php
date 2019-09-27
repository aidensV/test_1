@extends('welcome')
@section('content')

<form id="form-table" class="" method="post">

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Item</th>
                <th>qty</th>
                <th>Unit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dist as $data)

            <tr id="{{$data->id}}" dt="{{$data->detail_id}}">
                <td>{{$no++}}</td>
                <td>{{$data->date}}</td>
                <td>{{$data->i_name}}</td>
                <td>{{$data->qty}}</td>
                <td>
                    <select class="form-control" name="unit[]">
                        @foreach ($unit as $value)
                        @if ($value->u_id == $data->unit)
                        <option selected value="{{$value->u_id}}">{{$value->u_name}}</option>
                        @else
                        <option value="{{$value->u_id}}">{{$value->u_name}}</option>
                        @endif
                        @endforeach
                    </select>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{url('distribution')}}" class="btn btn-success" name="button">Kembali</a>
</form>

@endsection
