@extends('layouts.app')

@section('content')

@if (count($items) == 0)
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-bold mb-4">Carrito vacio, empeza a llenarlo:</h1>
</div>
<div class="flex flex-col items-center">
      

    <div class="">
    <p class="w-full text-center mt-6 w-full bg-blue-500 py-1.5 font-medium text-blue-50 ">Seguir Comprando</p>
    <x-products-explore :products="\App\Models\Product::all()" />
    </div>
@else
    <div class="container mx-auto py-4">
        <h1 class="text-2xl font-bold mb-4">Checkout</h1>

        <div class="grid grid-cols-2 gap-4">
            <form action="{{route('client.sale.store')}}" method="post">
                @csrf
                <input class="hidden" type="date" id="date" name="date" value="{{date("Y-m-d")}}" required>
                <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}" required>
                <div class="flex flex-wrap mb-4">
                    <div class="w-full md:w-1/2 px-3">
                    
                        <label class="block mb-2" for="name">Nombre</label>
                        <input class="border rounded w-full py-2 px-3" type="text" id="name" name="name" value="{{$user->name}}" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block mb-2" for="surname">Apellido</label>
                        <input class="border rounded w-full py-2 px-3" type="text" id="surname" name="surname" value="{{$user->surname}}" required>
                    </div>
                </div>
                <div class="flex flex-wrap mb-4">
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block mb-2" for="email">Direccion E-mail</label>
                        <input class="border rounded w-full py-2 px-3" type="email" id="email" name="email" value="{{$user->email}}" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block mb-2" for="phone">Teléfono</label>
                        <input class="border rounded w-full py-2 px-3" type="text" id="phone" name="phone" value="{{$user->phone}}" required>
                    </div>
                </div>
                <div class="flex flex-wrap mb-4">
                    <div class="w-full px-3">
                        <label class="block mb-2" for="address">Address</label>
                        <input class="border rounded w-full py-2 px-3" id="address" name="address" rows="3" value="{{$user->client->address->address}}" required>
                    </div>
                </div>
                <div class="flex flex-wrap mb-4">
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block mb-2" for="details">Detalles</label>
                        <input class="border rounded w-full py-2 px-3" type="text" id="details" name="details" value="{{$user->client->address->details}}" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block mb-2" for="zone">Codigo Postal</label>
                        <input class="border rounded w-full py-2 px-3" type="text" id="zone" name="zone" value="{{$user->client->address->zone->postal_code}}" required>
                    </div>
                </div>
                <div class="flex flex-wrap mb-4">
                    <div class="w-full px-3">
                        <label class="block mb-2" for="payment_method">Payment Method</label>
                        <select class="border rounded w-full py-2 px-3" id="payment_method" name="payment_type_id" required>
                            <option value="" readonly>-- Seleccionar Metodo de Pago --</option>
                            <option value="1">Tarjeta</option>
                            <option value="2">Efectivo</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">
                        Realizar Pedido
                    </button>
                </div>
            </form>
            
            
            <div>
<div class="max-h-96 overflow-y-auto overflow-x-hidden shadow-md sm:rounded-lg">
    
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Imagen</span>
                </th>
                <th scope="col" class="px-6 py-3">
                    Producto
                </th>
                <th scope="col" class="px-6 py-3">
                    Cantidad
                </th>
                <th scope="col" class="px-6 py-3">
                    Precio
                </th>
                <th scope="col" class="px-6 py-3">
                    Subtotal
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                    $test = 0;
                @endphp
            @foreach ($items as $item)
                
            @php
                        $subtotal = $item->price * $item->quantity;

                        $test += $subtotal;
                    @endphp
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-32 p-4">
                    <img src="/{{$item->model->image->url}}" alt="{{$item->name}}">
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    {{$item->name}}
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-3">
                        
                        <div>
                            <input type="number" id="first_product" class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$item->quantity}}" readonly>
                        </div>
                        
                    </div>
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    ${{$item->price}}
                </td>
                <td class="px-6 py-4">
                    <span class="font-medium text-indigo-600 dark:text-indigo-500 ">${{$test}}</span>
                </td>
            </tr>
            
            @endforeach
        </tbody>
    </table>
</div>
<div class="flex flex-row justify-evenly mt-3">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Valor Total del Carrito</h5>
    <h5 class="mb-2 text-right text-2xl font-bold tracking-tight text-gray-900 dark:text-white">${{$test}}</h5>
</div>
    <p class="font-normal text-gray-700 dark:text-gray-400"></p>


<div class="text-center mt-3">
    <a href="{{route('cart')}}">
    <button type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">Editar</button></a>
</div>
</div>

       
        </div>
    </div>
    @endif
@endsection
