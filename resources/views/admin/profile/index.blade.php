@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
{{ Breadcrumbs::render() }}
<hr>
<h2 class="display-4">Perfil de Administrador</h2>
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
        <div class="container py-2">      
          <div class="row mb-5">
            <div class="col-lg-4">
              <div class="card mb-4">
                <div class="card-body text-center">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                    class="rounded-circle img-fluid" style="width: 150px;">
                  <h5 class="my-3">{{$admin->name}}</h5>
                  <p class="text-muted mb-1">Administrador desde {{$admin->created_at}}</p>
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
                      <p class="text-muted mb-0">{{$admin->name}} {{$admin->surname}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$admin->email}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Teléfono</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$admin->phone}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Address</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$admin->admin->address->address}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                      <p class="mb-0"><a href="{{route('admin.profile.change-password')}}" class="btn btn-primary">Cambiar Contraseña</a></p>
                    </div>
                    <div class="col-sm-3">
                      <p class="text-muted mb-0"></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    @endif
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop