@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
{{Breadcrumbs::render()}}
<hr>
    <h1>Compra - ID {{$purchase->id}}</h1>
@stop


@section('content')
        {{-- Alpine JS --}}

<script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
<script src="//unpkg.com/alpinejs" defer></script>

<p>ID de Compra: {{$purchase->id}}</p>
<p>Proveedor: {{$purchase->supplier->name}}</p>
<p>Fecha: {{$purchase->date}}</p>
<p>Total: {{$purchase->total}}</p>


@stop
