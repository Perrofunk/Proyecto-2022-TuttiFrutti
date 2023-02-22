@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
{{Breadcrumbs::render()}}
<hr>
    
@stop


@section('content')
        {{-- Alpine JS --}}

<script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
<script src="//unpkg.com/alpinejs" defer></script>
<div class="card w-100 mb-0">
    <div class="card-body">
        <h5 class="card-title text-center">ID de Venta: {{$sale->id}}</h5>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Usuario</th>
                    <th>Tipo de pago</th>
                    <th>Fecha</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="{{route('users.show', ['user'=>$sale->user->id])}}">{{$sale->user->name}}</a></td>
                    <td>{{ucfirst(__($sale->paymentType->name))}}</td>
                    <td>{{$sale->date}}</td>
                    <td>{{$sale->total}}</td>
                </tr>
            </tbody>
        </table>

        <h5 class="card-title text-center m-0 py-2">Detalles de Venta</h5>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $test = 0;
                @endphp
                    @foreach ($sale->details as $item)
                    @php
                        $subtotal = $item->price * $item->quantity;

                        $test += $subtotal;
                    @endphp
                    <tr>
                    <td>{{$item->product->name}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$test}}</td>
                    </tr>
                @endforeach
                    
            </tbody>
        </table>
        <a class="btn btn-primary mt-2" href="{{route('sales.edit', ['sale'=>$sale])}}">Editar</a>
        <button onclick="if(confirm('¿Desea eliminar la venta ID [{{$sale->id}}]?')){
            event.preventDefault();
            document.getElementById('delete-sale').action='{{route('sales.destroy', ['sale'=>$sale])}}';
            document.getElementById('delete-sale').submit();
            }else{event.preventDefault();}" type="submit" class="btn btn-danger mt-2">Borrar Registro
        </button>
        <form id="delete-sale" class="d-none" action="" method="POST">
            @csrf
            @method('DELETE')
    </div>
</div>

@stop