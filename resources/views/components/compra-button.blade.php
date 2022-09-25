@props(['compra', 'proveedores', 'detalleCompras'])
@php
use App\Models\Product;
use App\Models\Category;

@endphp
<div class="border border-dark p-3 my-2" style="display: flex; flex-direction:column; width:40%">
    <h2 class="text-center card card-header">ID compra: {{ $compra->id }}</h2>

    <div class="card card-body">
        <h4>Fecha y hora: {{ $compra->fecha }}</h4>
        <h5>Proveedor: {{ $proveedores->where('id', $compra->supplier_id)->first()->nombre }}</h5>
        <h5>Total: {{ $compra->total }}</h5>
    </div>
</div>