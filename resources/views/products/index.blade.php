@extends('layouts.app')

@section('content')
    <div class=" container">
        <div class="row row-cols-1 row-cols-md-4 g-4">

            
            <x-products-component :products="$products" />
            

        </div>
    </div>
@endsection
