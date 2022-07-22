@extends('layouts.app')

@section('content')
    <div class=" container">
        <div class="row row-cols-1 row-cols-md-4 g-4">

            @foreach ($products as $product)
                <x-products-component :product="$product" />
            @endforeach

        </div>
    </div>
@endsection
