@extends('layouts.app')

@section('content')
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
            @foreach ($order->details as $item)
                
            @php
                        $subtotal = $item->price * $item->quantity;

                        $test += $subtotal;
                    @endphp
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-32 p-4">
                    <img src="/{{$item->product->image->url}}" alt="{{$item->name}}">
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    {{$item->product->name}}
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
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Total</h5>
    <h5 class="mb-2 text-right text-2xl font-bold tracking-tight text-gray-900 dark:text-white">${{$test}}</h5>
</div>
    <p class="font-normal text-gray-700 dark:text-gray-400"></p>



</div>

@endsection