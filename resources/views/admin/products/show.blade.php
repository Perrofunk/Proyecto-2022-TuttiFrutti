@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Productos - Index</h1>
    @stop

    @section('content')
    <h2>{{ $product['name'] }}</h2>
    @stop

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop