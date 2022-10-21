@extends('layouts.app')

@section('content_header')

    <h1>Productos - Index</h1>
    @stop
    
    @section('content')
<body class="antialiased" style="background-color: #C3CCE9">
    <div class="justify-center">       
        <h2 class="display-3">{{ $product['name'] }}</h2>
        <table class="table-bordered table-dark">
            <tr>
                <th>
                    <img src="/img/descarga.jpg" width="500" height="500">
                </th>
                <th>
                    <ul class="list-unstyled">
                        <ul>
                    <li> {{$product->description}} </li>
                </ul>
            </tr>
        </table> 
        <button type="button" class="btn btn-outline-dark">Light</button>
        <button type="button" class="btn btn-outline-dark">Dark</button>
    </div>
</body>

 
   

    @stop
    

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop