@extends('welcome')
@section('content')

            <div class="">

                <a href="{{route('data_stock.create')}}" class="btn btn-primary" style="float: left;" name="button">Tambah</a>
            </div>

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Owner</th>
                        <th>Nama Item</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($stock as $data)

                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$data->o_name}}</td>
                        <td>{{$data->i_name}}</td>
                        <td>{{$data->s_qty}}</td>
                        <td>
                            <form action="{{route('data_stock.destroy',$data->s_id)}}" method="post">
                                <a href="{{route('data_stock.edit',$data->s_id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="botttom" title="Detail Data" style="color:white;">Edit</a>
                                {{csrf_field()}}
                                {{method_field("DELETE")}}
                                <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Hapus Data" style="color:white;">Hapus</button>
                                {{-- <a  onclick='return confirm('Are you sure?')' class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Hapus Data" style="color:white;"><i class="fa  fa-trash"> </i></a> --}}
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

          @endsection
