@extends('layouts.app')

@section('content')
@if (count($orders) == 0)
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-bold mb-4">Aun no hay pedidos</h1>
</div>
<div class="flex flex-col items-center">
    <div class="">
    <p class="w-full text-center mt-6 w-full bg-blue-500 py-1.5 font-medium text-blue-50 ">Seguir Comprando</p>
    <x-products-explore :products="\App\Models\Product::all()" />
    </div>
@else
{{$orders->links('pagination::tailwind')}}
<div class="grid grid-cols-2 gap-4">
@foreach ($orders as $order)
    <a
  href="{{route('client.orders.show', ['order'=>$order])}}"
  class="group flex flex-col justify-between rounded-sm bg-white p-4 shadow-xl transition-shadow hover:shadow-lg sm:p-6 lg:p-8"
>
  <div>
    <h3 class="text-3xl font-bold text-indigo-600 sm:text-5xl">${{$order->total}}</h3>

    <div class="mt-4 border-t-2 border-gray-100 pt-4">
      <p class="text-sm font-medium uppercase text-gray-500">{{$order->date}}</p>
    </div>
  </div>

  <div
    class="mt-8 inline-flex items-center gap-2 text-indigo-600 sm:mt-12 lg:mt-16"
  >
    <p class="font-medium sm:text-lg">Detalles</p>

    <svg
      xmlns="http://www.w3.org/2000/svg"
      class="h-6 w-6 transition group-hover:translate-x-3"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M17 8l4 4m0 0l-4 4m4-4H3"
      />
    </svg>
  </div>
</a>

@endforeach
</div>
{{$orders->links('pagination::tailwind')}}

@endif
@endsection