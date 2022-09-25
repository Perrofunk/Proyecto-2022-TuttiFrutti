@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    
@section('content')
    <div class="d-flex flex-column">
        <h1 class=" text-center">Admin DASHBOARD</h1>
        <h4 class="" style="margin-left: 15%; margin-top:15px">Bienvenido [PLACEHOLDER]</h4>
    </div>
    <div class="container w-75 my-5 flex-wrap gap-3" style="display:flex;  flex-basis:50%; justify-content:center">

        {{-- Productos --}}
        <div class="d-flex justify-content-center flex-wrap" style="width: 40%">
            <div class="bg-light w-100 border border-2 border-light">
                <h3 class="text-center mt-2">PRODUCTOS</h3>
                <a class="btn btn-primary w-100 py-3 border rounded-0 border-primary" href="/admin/products/index" role="button">INDEX</a>
                <a role="button" class="btn btn-secondary w-100 border rounded-0 border-secondary" href="/admin/products/create">CREAR</a>
            </div>
        </div>

        {{-- Compras --}}
        <div class="d-flex justify-content-center flex-wrap" style="width: 40%">
            <div class="bg-light w-100 border border-2 border-light">
                <h3 class="text-center mt-2">COMPRAS</h3>
                <a class="btn btn-primary w-100 py-3 border rounded-0 border-primary" href="/admin/compras/index" role="button">INDEX</a>
                <a role="button" class="btn btn-secondary w-100 border rounded-0 border-secondary" href="/admin/compras/create">CREAR</a>
            </div>
        </div>

    </div>
@endsection
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


