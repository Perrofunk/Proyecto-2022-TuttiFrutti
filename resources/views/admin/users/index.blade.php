@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1>Usuarios Registrados</h1>
@stop

@section('content')

<div class="d-flex">

    <div class="row row-cols-3">
   
    @foreach ($users as $user)
    <x-users-card-component :user="$user"></x-users-card-component>
    
    @endforeach
    </div>

</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>.card{
        width: 400px;
        border: none;
        border-radius: 10px;
         
        background-color: #fff;
      }
      
      
      
      .stats{
      
            background: #f2f5f8 !important;
      
          color: #000 !important;
      }
      .articles{
        font-size:10px;
        color: #a1aab9;
      }
      .number1{
        font-weight:500;
      }
      .followers{
          font-size:10px;
        color: #a1aab9;
      
      }
      .number2{
        font-weight:500;
      }
      .rating{
          font-size:10px;
        color: #a1aab9;
      }
      .number3{
        font-weight:500;
      }</style>
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop