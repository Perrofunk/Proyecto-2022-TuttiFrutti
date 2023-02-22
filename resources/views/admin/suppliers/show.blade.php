@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
{{Breadcrumbs::render()}}
<hr class="mt-3">
    <h1>ID Proveedor: {{$supplier->id}}</h1>
@stop

@section('content')
    @php
        $total = 0;
        foreach ($supplier->purchases as $purchase) {
            $test = $purchase->total;
            $total += $test;
        }
        
    @endphp
<p>Nombre: {{$supplier->name}}</p>
<p>Email: {{$supplier->email}}</p>
<p>Contacto: {{$supplier->contact}}</p>
<p>Direccion: {{$supplier->address}}</p>
<p>Telefono: {{$supplier->phone}}</p>
<hr>
@if (count($supplier->purchases))
    <p>Compras:</p>
    <p>Cantidad de Compras: {{count($supplier->purchases)}}</p>
    <p>Valor Total de Todas las Compras: ${{$total}}</p>
    @foreach ($supplier->purchases as $purchase)
        <p>ID de Compra: {{$purchase->id}}</p>
        <p>Total de Compra: {{$purchase->total}}</p>
        <br>
    @endforeach
@else
    <p class="mb-2">Este proveedor no tiene ninguna compra registrada</p>
    <a href="{{route('purchases.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">CLICK ACA PARA REGISTRAR UNA</a>
@endif

  
  
    

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop