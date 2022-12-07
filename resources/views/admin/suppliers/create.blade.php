@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
{{ Breadcrumbs::render() }}
<hr class="mt-3">
    <h1>Dashboard</h1>
@stop

@section('content')
    


<div class="">
<x-crud.forms type="create" :variable="$suppliers" route="suppliers"></x-crud.forms>
</div>
  
  
    

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop