@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Dashboard</h1>
@stop

@section('content')
    

    <div class="d-flex flex-column">
        <h4 class="" style="margin-left: 15%; margin-top:15px">Bienvenido {{Auth::user()->name}} {{Auth::user()->surname}}</h4>
    </div>
    <div class="container w-75 my-5 flex-wrap gap-3" style="display:flex;  flex-basis:50%; justify-content:center">

        
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


