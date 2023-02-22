@extends('layouts.app')

@section('content')
   
<style>
    @layer utilities {
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  }
</style>


    @if (count($items) == 0)
    <div class="container mx-auto py-4">
      <h1 class="text-2xl font-bold mb-4">Carrito vacio, empeza a llenarlo:</h1>
  </div>
  <div class="flex flex-col items-center">
        
  
      <div class="">
      <p class="w-full text-center mt-6 w-full bg-blue-500 py-1.5 font-medium text-blue-50 ">Seguir Comprando</p>
      <x-products-explore :products="\App\Models\Product::all()" />
      </div>
  </div>
  </div>
    @else
 
  <div class="h-full bg-gray-100 pt-20">
    <h1 class="mb-10 text-center text-2xl font-bold">Carrito</h1>

    {{-- Formulario --}}
    <form id="cart-checkout-form" action="{{ route("cart.update") }}" method="POST" enctype="multipart/form-data">
      @method('PATCH')
      @csrf
      <input id="checkout" type="hidden" name="checkout" value="">
    <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
      <div class="rounded-lg md:w-2/3">
        @foreach ($items as $item)
        <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
          <img src="{{$item->model->image->url}}" alt="product-image" class="w-full rounded-lg sm:w-40" />
          <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">

            <div class="mt-5 sm:mt-0">
              <h2 class="text-lg font-bold text-gray-900">{{$item->model->name}}</h2>
              <p class="mt-1 text-xs text-gray-700">{{$item->model->category->name}}</p>
            </div>
            
            <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
              <div class="flex items-center border-gray-100">
                <span class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50" onclick="if(document.getElementById('quantity{{$item->id}}').value > 1){document.getElementById('quantity{{$item->id}}').value--}"> - </span>
                <input id="quantity{{$item->id}}" name="quantities[]" class="h-8 w-1/2 border bg-white text-center text-xs outline-none" type="number" value="{{$item->quantity}}" min="1" />
                <span class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50" onclick="document.getElementById('quantity{{$item->id}}').value++"> + </span>
              </div>
              <div class="flex items-center space-x-4">
                <p class="text-sm">${{$item->price}}</p>
                <button onclick="if(confirm('¿Seguro que deseas eliminar {{$item->name}} de tu carrito?')){
                    event.preventDefault();
                    document.getElementById('product_id').value={{$item->id}};
                    document.getElementById('delete-cart').submit();
                    }else{event.preventDefault();}" type="submit" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500" >
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                    </button>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      </form>

      <!-- Sub total -->
      <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
        <div class="mb-2 flex justify-between">
          <p class="text-gray-700">Subtotal</p>
          <p class="text-gray-700">${{\Cart::session(auth()->user()->id)->getSubTotal()}}</p>
        </div>
        <div class="flex justify-between">
          
        </div>
        <hr class="my-4" />
        <div class="flex justify-between">
          <p class="text-lg font-bold">Total</p>
          <div class="">
            <p class="mb-1 text-lg font-bold">${{\Cart::session(auth()->user()->id)->getTotal()}}</p>
            
          </div>
        </div>
        <a href="{{route('products.index')}}"><button type="button" class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600">Seguir Comprando</button></a>
        
        <button onclick="document.getElementById('checkout').value='false';document.getElementById('cart-checkout-form').submit" class="mt-1 w-full rounded-md bg-yellow-500 py-1.5 font-medium text-blue-50 hover:bg-yellow-600">Actualizar Total</button>
        <button onclick="document.getElementById('checkout').value='true';document.getElementById('cart-checkout-form').submit" class="mt-1 w-full rounded-md bg-green-500 py-1.5 font-medium text-blue-50 hover:bg-green-600">Finalizar</button>
      </div>
  </div>
    </div>
  </div>
  <form id="delete-cart" class="d-none" action="{{route('cart.remove')}}" method="POST">
    @csrf
    @method('DELETE')
    <input id="product_id" type="hidden" name="product_id">
</form>
@endif
@endsection
