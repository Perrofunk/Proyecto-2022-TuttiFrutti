@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center d-none">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h2>Bienvenido <span class="fw-bold">{{ Auth::user()->name }}</span></h2>
        </div>
        
        <div class="d-flex pt-5 justify-content-center btn-group">

            <a href="products"><button class="btn-light">Productos</button></a>

            <a href="#"><button class="btn-light">Contacto</button></a>
        </div>
    </div>
@endsection
