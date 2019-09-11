@extends('welcome')
@section('content')
            <form action="{{route('data_stock.update',$stock->s_id)}}" method="post">
              @csrf
              {{method_field('PUT')}}
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Owner</label>
                    {{-- <input type="text" name="u_name" class="form-control"  placeholder="Nama"> --}}
                    <select class="form-control" name="s_id_owner">
                      @foreach ($owner as $data)
                      <option value="{{$data->o_id}}">{{$data->o_name}}</option>
                    @endforeach
                    </select>
                </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Item</label>
                    {{-- <input type="text" name="u_name" class="form-control"  placeholder="Nama"> --}}
                    <select class="form-control" name="s_id_item">
                      @foreach ($item as $data)
                      <option value="{{$data->i_id}}">{{$data->i_name}}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah</label>
                    <input type="number" name="s_qty" value="{{$stock->s_qty}}" class="form-control"  placeholder="Jumlah">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
          @endsection
