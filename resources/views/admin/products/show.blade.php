@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Productos - Index</h1>
    @stop

    @section('content')
    <h2 class="display-2">{{ $product['name'] }}</h2>
    <table class="table-bordered table-dark">
        <tr>
            <th>
                <img src="public\img\descarga.jpg">
            </th>
            <th>
            <ul class="list-unstyled">
                <ul>
                    <li> {{$product->description}} </li>
                </ul>
              
            </ul>
            
            </th>
        </tr>
    </table>
    

    @stop
    

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop