@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop


@section('content')

@php
use App\Models\Product;
use App\Models\Category;

@endphp


    <section>
        {{-- Header --}}
        
    <div style="display: flex; justify-content:space-evenly">

        <a role="button" class="btn btn-primary w-25 mt-3" href="create">
            Registrar Nueva Compra
        </a>

    </div>
        </header>


    {{-- Main --}}
    <div style="display: flex; flex-wrap:wrap; justify-content:space-evenly; align-items:flex-start">
        @foreach ($compras as $compra)
            <x-compra-button :compra="$compra" :proveedores="$proveedores" :detalleCompras="$detalleCompras"></x-compra-button>
        

            
            
        @endforeach
            
        </div>
    </section>





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
