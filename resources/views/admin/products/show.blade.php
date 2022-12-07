@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    {{Breadcrumbs::render()}}
    <hr class="mt-3">
    <h1>{{$product->name}}</h1>
    @stop

    @php
    function test($product) {
        $count = [];
        foreach ($product->details as $detail) {
        array_push($count, $detail->purchase_id);
    }
    $count = array_unique($count);
    return count($count);
    }
    @endphp
    @section('content')
    <h2 class="display-2">{{ $product['name'] }}</h2>
    <p>cantidad de compras que contienen este producto: {{test($product)}}
    </p>
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