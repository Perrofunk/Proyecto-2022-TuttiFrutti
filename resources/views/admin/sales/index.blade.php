@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
{{ Breadcrumbs::render() }}

<h2>Registro de Compras</h2>
@stop


@section('content')
    {{-- Header --}}

    {{-- Alpine JS --}}
    <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
        @php
            $modelos = App\Models\PaymentType::all();
        @endphp
        <p class="text-secondary">
            Total de registros: {{$sales->total()}}
        </p>
    <x-crud.filters :variable="$sales" :relacion_modelos="$modelos">
        <a role="button" class="w-100 btn btn-primary mt-3" href="{{route('sales.create')}}">
            Registrar Nueva Venta
        </a></x-crud.filters>
    <x-crud.views :variable="$sales" ruta="sales"></x-crud.views>
    
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
