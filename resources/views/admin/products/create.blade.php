@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    

@php
    use App\Models\Category;
    $productCategory=Category::all();
@endphp
    <form method="POST" action="/"">
        @csrf
        <div>
            <label for="name">
                Nombre Producto
            </label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="category_id">
                Categoria
            </label>
            <select name="category_id">
            <option value="1">Fruta</option>
            <option value="2">Verdura</option>
            <option value="3">Otro</option>
            </select>
        </div>
    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop