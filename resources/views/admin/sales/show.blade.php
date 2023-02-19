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
<div class="card w-100">
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

        <h5 class="card-title text-center mt-5">Detalles de Venta</h5>
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
    </div>
</div>

@stop