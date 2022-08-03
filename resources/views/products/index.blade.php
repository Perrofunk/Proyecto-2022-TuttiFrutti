@extends('layouts.app')

@section('content')
    <div class="container">
        <x-partials.search action="/products"></x-partials.search>
    </div>
    <div class=" container">
        @if ($error ?? false)
            <div class="d-flex justify-content-center p-5 m-5">
                <h3>
                    {{ $error }}
                </h3>
            </div>
        @else
            <div class="row row-cols-2 row-cols-md-4 g-4">

                <x-products-component :products="$products" />


            </div>
        
            @endif
    </div>
@endsection
