@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Compras - Index</h1>
@stop


@section('content')
    {{-- Header --}}

    {{-- Alpine JS --}}
    <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <h3>Registro de Compras</h3>

    {{-- Main --}}
    {{-- style="display: flex; flex-wrap:wrap; justify-content:space-evenly; align-items:flex-start" --}}



    {{-- Filtros --}}
    <div x-data="{ card: $persist(true), table: $persist(false) }">
        <div class="row">
            <div class="col">
                <p class="text-secondary">
                    Mostrando {{$purchases->count()}} resultados.
                </p>
            </div>
            <div class="col ">
                    <h2 class="" style="display: flex; justify-content:space-evenly">
                    <a role="button" class="btn btn-primary mt-3" href="{{route('products.create')}}">
                        Registrar Compra
                    </a>
                </h2>
            </div>
            <div class="col">
            </div>
        </div>

         <div class="row mb-2">
        
<form class="" method="" action="">
    @csrf
    <legend>Filtros</legend>
    <div class="input-group-text">
        <label class="form-label" for="form1"></label>
        <input type="text" name="search" id="form1" class="" />
        <button class="btn btn-outline-primary border-0 rounded-0" type="submit">Search</button>
      </div>
    <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupSelect01">Proveedor</label>
        <select name="supplier_id" class="form-select" id="inputGroupSelect01">
          <option aria-placeholder="Seleccionar..." value="">
          Seleccionar...
           </option>
           @foreach (App\Models\Supplier::all() as $supplier)    
            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
           @endforeach
        </select>
      </div>
    <div class="input-group">
        <label class="input-group-text" for="inputGroupSelect02">Ordenar por</label>
        <select name="orderBy" class="form-select" id="inputGroupSelect02">
          <option aria-placeholder="Seleccionar..." value="">Seleccionar...</option>
          <option value="id">ID</option>
          <option value="date">Fecha</option>
          <option value="total">Total</option>
        </select>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-check">
            <input class="form-check-input" value="asc" type="radio" name="order" id="flexRadioDefault1" checked>
            <label class="form-check-label" for="flexRadioDefault1">
              Ascendente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="desc" type="radio" name="order" id="flexRadioDefault2">
            <label class="form-check-label" for="flexRadioDefault2">
              Descendente
            </label>
          </div>
        </div>
        <div class="col d-flex align-items-center">
            <button class="btn btn-primary" type="submit">Aplicar</button>
          </div>
          <div class="col">
          </div>
            </div>
  </form>






        <div class="d-flex flex-column-reverse">
        <div class="btn-group" role="group" aria-label="Button group">
            <button class="btn rounded-0 btn-primary" x-on:click="card = true, table = false">
                Vista De Carta
            </button>
            <button class="btn rounded-0 btn-primary" x-on:click="card = false, table = true">
                Vista De Tabla
            </button>
        </div>
        </div>

        <div x-transition x-show.important="card" class="row row-cols-2 row-cols-md-4">
            @foreach ($purchases as $purchase)
            
                <x-compra-card :purchase="$purchase" />
            @endforeach
        </div>
        <div x-transition x-show.important="table">
            <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Total</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col" class=" bg-primary border-top-0 border-right-0">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchase)
                        <x-compra-table :purchase="$purchase" />
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Links de Paginacion --}}
    {{ $purchases->links() }}

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
