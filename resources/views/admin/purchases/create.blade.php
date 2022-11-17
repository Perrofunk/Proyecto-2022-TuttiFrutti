@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    

@php
    use App\Models\Supplier;
    $supplier=Supplier::all();
    $details = App\Models\PurchaseDetail::all();
@endphp
<div class="">
<x-crud.forms  :relationship_child_models="$details"  type="create" :variable="$purchases" :relationship_parent_models="$supplier"></x-crud.forms>
</div>
  
  
    

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop




