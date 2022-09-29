@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Compras - Index</h1>
@stop


@section('content')
        {{-- Header --}}
            
        <h2 style="display: flex; justify-content:space-evenly">
            <a role="button" class="btn btn-primary w-25 mt-3" href="create">
                Registrar Nueva Compra
            </a>
        </h2>

        <h3>Registro de Compras</h3>

        {{-- Main --}}
        {{-- style="display: flex; flex-wrap:wrap; justify-content:space-evenly; align-items:flex-start"--}}
            

        
    <div class="row row-cols-2 row-cols-md-4">
        @foreach ($compras as $compra)
        
            <x-compra-button :compra="$compra" />
            
        @endforeach
    </div>
    {{-- Links de Paginacion --}}
    {{ $compras->links() }}

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop