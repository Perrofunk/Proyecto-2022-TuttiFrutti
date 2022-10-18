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
    <div x-data="{ card: $persist(true), table: $persist(false) }">
        <h2 style="display: flex; justify-content:space-evenly">
            <a role="button" class="btn btn-primary w-25 mt-3" href="create">
                Registrar Nueva Compra
            </a>
        </h2>

        <div class="d-flex flex-column-reverse">
        <div class="btn-group" role="group" aria-label="Button group">
            <button class="btn rounded-0 btn-primary" x-on:click="card = true, table = false">
                Vista De Carta
            </button>
            <button class="btn rounded-0 btn-primary" x-on:click="card = false, table = true">
                Vista De Tabla
            </button>
        </div>
            <form class="input-group flex-row align-items-center" action="/">
                
                <div class="form-outline">
                  <input type="text" name="search" id="form1" class="" />
                  <label class="form-label" for="form1"></label>
                </div>
                
                <div>
                    <button class="btn rounded-0 btn-dark" type="submit">Search</button>
                </div>
            </form>
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
