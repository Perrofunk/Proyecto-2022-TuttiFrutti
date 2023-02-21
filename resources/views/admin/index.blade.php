@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Dashboard</h1>
@stop

@section('content')
    @php
        $sales = App\Models\Sale::all();
        $card_sales = App\Models\Sale::where('payment_type_id', '=', '1')->get()->count();
        $ventas_totales = count($sales);
        $valor_ventas_totales = 0;
        foreach ($sales as $sale) {
            $valor_ventas_totales += $sale->total;
        }

        $purchases = App\Models\Purchase::all();
        $compras_totales = count($purchases);
        $valor_compras_totales = 0;
        foreach ($purchases as $purchase) {
            $valor_compras_totales += $purchase->total;
        }

        $users = App\Models\User::all();
        $usuarios_totales = $users->count();
    @endphp

   
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Valor de Ventas</h6>
                    <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span>${{$valor_ventas_totales}}</span></h2>
                    <p class="m-b-0">Ventas Registradas<span class="f-right">{{$ventas_totales}}</span></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Valor de Compras</h6>
                    <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span>${{$valor_compras_totales}}</span></h2>
                    <p class="m-b-0">Compras Registradas<span class="f-right">{{$compras_totales}}</span></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Usuarios</h6>
                    <h2 class="text-right"><i class="fas fa-fw fa-user f-left"></i><span>{{$usuarios_totales}}</span></h2>
                    <p class="m-b-0"><span class="f-right">Usuarios Registrados</span></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Ventas con Tarjeta</h6>
                    <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span>{{$card_sales}}</span></h2>
                    <p class="m-b-0"><span class="f-right">De Credito o Debito</span></p>
                </div>
            </div>
        </div>
	</div>
</div>
        

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://kit.fontawesome.com/0419bd56a3.js" crossorigin="anonymous"></script>
@stop


