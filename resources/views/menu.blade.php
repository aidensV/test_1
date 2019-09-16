@extends('welcome')
@section('content')

<div class="links">
    <a href="{{url('data_item')}}">Data Item</a>
    <a href="{{url('data_unit')}}">Data Satuan</a>
    <a href="{{url('data_owner')}}">Data Owner</a>
    <a href="{{url('data_stock')}}">Data Stock</a>
    <a href="{{url('sales')}}">Sales</a>
    {{-- <a href="https://nova.laravel.com">Nova</a> --}}
    {{-- <a href="https://forge.laravel.com">Forge</a> --}}
    {{-- <a href="https://github.com/laravel/laravel">GitHub</a> --}}
</div>
@endsection
