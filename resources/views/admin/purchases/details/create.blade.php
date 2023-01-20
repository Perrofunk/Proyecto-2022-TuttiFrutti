@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
{{Breadcrumbs::render()}}
<hr class="mb-3">
    <h1>Dashboard</h1>
@stop

@section('content')
    @php
        use App\Models\Product;
        $products = Product::all();
    @endphp

<div class="">
    
<x-crud.forms  type="create" :first_parent_models="$products" :second_parent="$purchase" :variable="$detail"></x-crud.forms>
</div>
  
  
    

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
