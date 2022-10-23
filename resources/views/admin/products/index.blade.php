@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Productos - Index</h1>
    @stop

    @section('content')
    <x-partials.alpine />
    <div x-data="{ card: $persist(true), table: $persist(false) }">
        <h2 style="display: flex; justify-content:space-evenly">
            <a role="button" class="btn btn-primary w-25 mt-3" href="{{route('products.create')}}">
                Registrar Nuevo Producto
            </a>
        </h2>

        <div class="d-flex flex-column-reverse">
        <div class="btn-group" role="group" aria-label="Button group">
            <button class="btn rounded-0 btn-primary" x-on:click="card = true, table = false">
                Vista De Carta
            </button>
            <button class="btn rounded-0 btn-primary" x-on:click="card = false, table = true">
                Vista De Tabla
            </button>
        </div>
        </div>
    <div x-transition x-show.important="card" class="row row-cols-2 row-cols-md-4 g-4">

    <x-products-component :products="$products" :variable="true" />


    </div>
    <div x-transition x-show.important="table">
        <table class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Categoria</th>
                    <th scope="col" class="bg-primary border-primary border-bottom-0">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td><a href="#">{{$product->category->name}}</a></td>
                    <td class="d-flex justify-content-end"><div class="btn-group">
                        <button class="btn rounded-0  btn-outline-info">Modificar</button>
                        <button class="btn rounded-0  btn-danger">Borrar</button>
                    </div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $products->links() }}
    @stop

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop