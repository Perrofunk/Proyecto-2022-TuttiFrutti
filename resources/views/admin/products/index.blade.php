@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Productos - Index</h1>
    @stop

    @section('content')
    <div class="row row-cols-2 row-cols-md-4 g-4">
    <x-products-component :products="$products" />
    </div>
    {{ $products->links() }}
    @stop

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop