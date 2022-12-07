@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    {{Breadcrumbs::render()}}
    <hr>
    <h1> Compra ID {{$purchase->id}} - Detalles</h1>
@stop

@section('content')
{{-- Alpine JS --}}

<script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
<script src="//unpkg.com/alpinejs" defer></script>

<p>ID de Compra: {{$purchase->id}}</p>
<p>Proveedor: {{$purchase->supplier->name}}</p>
<p>Fecha: {{$purchase->date}}</p>
<p>Total: {{$purchase->total}}</p>
<h3>Detalles de Compra</h3>

        
    <div x-data="{ card: $persist(true), table: $persist(false) }">
        <div class="row mb-3">
            <div class="col"></div>
        <a role="button" class="btn btn-primary mt-3 col" href="{{route('details.create', ['purchase'=>$purchase])}}">
            Añadir Detalle de Compra
        </a>
        <div class="col"></div>
        </div>
        
  <x-crud.views :manualPaginator="true" :variable="$detail" :parent="$purchase" ruta="details"></x-crud.views>
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