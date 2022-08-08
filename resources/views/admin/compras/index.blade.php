@extends('layouts.app')
@php
use App\Models\Product;
use App\Models\Category;

@endphp
@section('content')

    <section>
        {{-- Header --}}
        <header>
    <a role="button" class="btn btn-outline-dark btn-sm" href="/admin">Volver al Dashboard</a>
    <h1 class="text-center">Compras</h1>
    <div style="display: flex; justify-content:space-evenly">

        <a role="button" class="btn btn-primary w-25 mt-3" href="create">
            Registrar Nueva Compra
        </a>

    </div>
        </header>


    {{-- Main --}}
    <div style="display: flex; flex-wrap:wrap; justify-content:space-evenly; align-items:flex-start">
        @foreach ($compras as $compra)
            <div class="border border-dark p-3 my-2" style="display: flex; flex-direction:column; width:40%">
                <h2 class="text-center card card-header">ID compra: {{ $compra->id }}</h2>

                <div class="card card-body">
                    <h4>Fecha y hora: {{ $compra->fecha }}</h4>
                    <h5>Proveedor: {{ $proveedores->where('id', $compra->supplier_id)->first()->nombre }}</h5>
                    <h5>Total: {{ $compra->total }}</h5>
                </div>

                <h5 class="text-center border border-dark">
                    <a class="btn w-100" role="button" data-bs-toggle="collapse"
                        href="#collapseExample{{ $compra->id }}">Detalles de la compra: 
                    </a>
                </h5>

                <div class="collapse" id="collapseExample{{ $compra->id }}">
                    @foreach ($detalleCompras as $detalleCompra)
                        @if ($detalleCompra->compra_id === $compra->id)
                            @php
                                $product = Product::where('id', $detalleCompra->product_id)->first();
                            @endphp

                            <p>

                                ID Producto: {{ $product->id }}<br>
                                Nombre: {{ $product->name }}<br>
                                Descripcion: {{ $product->description }}<br>
                                Categoria: {{ Category::where('id', $product->category_id)->first()->name }}<br>
                                Imagen: <img src="/{{ $product->img_route }}", height="50px" width="50px"><br>
                                <span style="word-wrap:break-word">Ruta a la Imagen: {{ $product->img_route }}</span><br>
                                Cantidad comprada: {{ $detalleCompra->cantidad }}<br>
                                Costo unitario: {{ $detalleCompra->costo_unitario }}<br>
                                Subtotal: {{ $detalleCompra->costo_unitario * $detalleCompra->cantidad }}<br>
                                <a role="button" class="btn btn-danger mt-3" href="">Borrar</a>

                                <hr class="my-5">

                            </p>
                        @endif
                    @endforeach

                </div>

                <a role="button" class="btn btn-danger mt-3 w-100" href="">Eliminar Registro</a>
            </div>
        @endforeach
    </div>
    </section>


@endsection
