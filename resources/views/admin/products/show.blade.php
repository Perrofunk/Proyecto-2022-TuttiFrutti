@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    {{Breadcrumbs::render()}}
    <hr class="mt-3">
    
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
    <p>Cantidad de compras que contienen este producto: {{test($product)}}
    </p>
        <div class="row">
            <div class="col-4">
                <img height="250px" width="250px" src="/{{$product->image->url}}">
            </div>
            <div class="col">
                <ul class="text-lg list-unstyled">
                    <li>
                        Descripcion del producto: {{$product->description}}
                    </li><br>
                    <li>
                        Precio registrado: ${{$product->price}}
                    </li>
                    <li>
                        Categoria ID {{$product->category->id}}: {{$product->category->name}}
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
        </div>
    

    @stop
    

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop