@extends('welcome')
@section('content')
            <form action="{{route('data_item.store')}}" method="post">
              @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" name="i_name" class="form-control"  placeholder="Nama">
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Satuan</label>
                    {{-- <input type="text" name="u_name" class="form-control"  placeholder="Nama"> --}}
                    <select class="form-control" name="i_id_unit">
                      @foreach ($unit as $data)
                      <option value="{{$data->u_id}}">{{$data->u_name}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Harga</label>
                    <input type="text" name="i_price" class="form-control"  placeholder="Nama">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
          @endsection
