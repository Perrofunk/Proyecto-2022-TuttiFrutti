@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Productos - Index</h1>
    @stop

    @section('content')


    {{-- Filtros --}}
    <x-partials.alpine />
    <div x-data="{ card: $persist(true), table: $persist(false) }">
        <div class="row">
            <div class="col">
                <p class="text-secondary">
                    Mostrando {{$products->count()}} resultados.
                </p>
            </div>
            <div class="col ">
                    <h2 class="" style="display: flex; justify-content:space-evenly">
                    <a role="button" class="btn btn-primary mt-3" href="{{route('products.create')}}">
                        Registrar Nuevo Producto
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
        <label class="input-group-text" for="inputGroupSelect01">Categorias</label>
        <select name="category_id" class="form-select" id="inputGroupSelect01">
          <option aria-placeholder="Seleccionar..." value="">
          Seleccionar...
           </option>
           @foreach (App\Models\Category::all() as $category)    
           <option value="{{$category->id}}">{{$category->name}}</option>
          @endforeach
        </select>
      </div>
    <div class="input-group">
        <label class="input-group-text" for="inputGroupSelect02">Ordenar por</label>
        <select name="orderBy" class="form-select" id="inputGroupSelect02">
          <option aria-placeholder="Seleccionar..." value="">Seleccionar...</option>
          <option value="id">ID</option>
          <option value="name">Orden Alfabético</option>
          <option value="price">Precio</option>
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



  
        {{-- <div class="col text-center">
            <span class=" text-secondary">Filtrar por Categoria</span>
            <div class="btn-group">
            <button class="btn btn-primary">{{App\Models\Category::all()['0']->name}}</button>
            <button class="btn btn-primary">{{App\Models\Category::all()['1']->name}}</button>
            <button class="btn btn-primary">{{App\Models\Category::all()['2']->name}}</button>
            </div>
        </div>
        <div class="col"></div> --}}
    </div>
    
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
        
    <div x-transition x-show.important="card" class="row row-cols-2 row-cols-md-4 g-4">

    <x-products-component :products="$products" :variable="true" />


    </div>
    <div x-transition x-show.important="table">
        <table class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Categoria</th>
                    <th scope="col" class="bg-primary border-primary border-bottom-0">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td><a href="?category_id={{$product->category_id}}">{{$product->category->name}}</a></td>
                    <td class="d-flex justify-content-end"><div class="btn-group">
                        <a class="btn rounded-0  btn-outline-warning" href="{{route('products.edit', ['product'=>$product])}}">Modificar</a>
                          <button onclick="if(confirm('Esta a punto de eliminar el elemento [{{$product->id}}] de la tabla [Productos]')){
                          event.preventDefault();
                          document.getElementById('delete-table').action='{{route('products.destroy', ['product'=>$product])}}';
                          document.getElementById('delete-table').submit();
                          }else{event.preventDefault();}" type="submit" class="btn rounded-0 btn-danger">Borrar</button>
                    </div></td>
                </tr>
                @endforeach
                <form id="delete-table" class="d-none" action="" method="POST">
                  @csrf
                  @method('DELETE')
                </form>
            </tbody>
        </table>
    </div>
    {{ $products->links() }}
    @stop

    @section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop