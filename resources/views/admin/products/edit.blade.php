@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    

@php
    use App\Models\Category;
    $categories=Category::all();
    $details = App\Models\PurchaseDetail::all();
@endphp
<div class="">
<x-crud.forms  type="edit" :variable="$product" ruta="products" :relationship_parent_models="$categories"></x-crud.forms>
</div>
  
  
    

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop