@extends('layouts.app')

@section('content_header')

    <h1 class="aling-center">Productos - Index</h1>
    @stop
    
    @section('content')
    <!-- component -->
    @if(session()->has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
      <span class="font-medium">{{ session()->get('success') }}</span> <a href="{{route('cart')}}" class="hover:text-blue-900"> Acceder al carrito </a>
    </div>


@endif.
<section class="text-gray-700 body-font overflow-hidden bg-white">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-4/5 mx-auto flex flex-wrap">
      <img alt="{{$product->name}}" class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200" src="/{{$product->image->url}}">
      <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
        <h2 class="text-sm title-font text-gray-500 tracking-widest">{{$product->category->name}}</h2>
        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{$product->name}}</h1>
        <div class="flex mb-4">
          
          
        </div>
        <p class="leading-relaxed">{{$product->description}}</p>
        <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">
          <div class="flex">
           
          </div>
          <div class="flex ml-6 items-center">
            
          </div>
        </div>
        <div class="flex">
          <span class="title-font font-medium text-2xl text-gray-900">${{$product->price}}</span>
          <form action="{{ route('cart.add') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    <label class="mr-2">Quantity:</label>
                    <input type="number" name="quantity" value="1" min="1" class="border rounded py-1 px-2">
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-1 px-4 rounded">
                    Add to Cart
                </button>
            </div>
        </form>
        
          <input class=" w-10 h-10 bg-gray-200 p-0 inline-flex items-center justify-center text-gray-500 ml-4" type="number" min="1">
          <button class="flex ml-auto text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded" type="submit">Añadir al Carrito</button>
        </div>
      </div>
    </div>
  </div>
</section>
</body>

 
   

    @stop
    

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop