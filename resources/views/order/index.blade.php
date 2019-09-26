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
                                <a href="{{route('order.edit',$data->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="botttom" title="Detail Data" style="color:white;">Detail</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

          @endsection
