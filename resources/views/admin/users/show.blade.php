@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
{{ Breadcrumbs::render() }}
<hr>
<h2 class="display-4">Perfil de Usuario</h2>
@stop


@section('content')
    {{-- Header --}}

    {{-- Alpine JS --}}
    <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @if ($errors->any())
            {{($errors->first())}} <a href="{{route('admin.index')}}" class="btn btn-primary" type="button">Volver</a>
    @else
    <section style="background-color: #eee;">
        @php
            $test = $user->userType->name;
        @endphp
        <div class="container py-2">      
          <div class="row mb-1">
            <div class="col-lg-4">
              <div class="card mb-4">
                <div class="card-body text-center">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                    class="rounded-circle img-fluid" style="width: 150px;">
                  <h5 class="my-3">{{$user->name}}</h5>
                  <p class="text-muted mb-1">Miembro desde {{$user->created_at}}</p>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Nombre Completo</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$user->name}} {{$user->surname}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$user->email}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Teléfono</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$user->phone}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Address</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$user->$test->address->address}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                        @if ($user->id == auth()->user()->id)
                        <p class="mb-0"><a href="{{route('admin.profile.change-password')}}" class="btn btn-primary">Cambiar Contraseña</a></p>
                        @else
                        {{-- <p class="mb-0"><a href="{{route('users.destroy', ['user'=>$user])}}" class="btn btn-danger">Borrar Usuario</a></p> --}}
                        <p class="mb-0"><button onclick="if(confirm('Desea eliminar el usuario [{{$user->name}} {{$user->surname}} ID {{$user->id}}]')){
                          event.preventDefault();
                          document.getElementById('delete-user').action='{{route('users.destroy', ['user'=>$user])}}';
                          document.getElementById('delete-user').submit();
                          }else{event.preventDefault();}" type="submit" class="btn btn-danger">Borrar Usuario</button> </p>
                        @endif
                    </div>
                    <form id="delete-user" class="d-none" action="" method="POST">
                      @csrf
                      @method('DELETE')
                  </form>
                    <div class="col-sm-3">
                        
                      <p class="text-muted mb-0"></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @if ($user->user_type == "3")
          @if ($user->sales->count() != null)
          <h3 class="mb-2 text-center">Compras</h3>
            @foreach ($user->sales as $sale)
                <x-sales-card :sale="$sale"/>
              
            @endforeach
          @else
            <h3 class="text-center m-0 pb-4">Este usuario no tiene ninguna compra registrada</h3>
          @endif
        @endif
      </section>
    @endif
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
      .card-horizontal {
    display: flex;
    flex: 1 1 auto;
}
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop