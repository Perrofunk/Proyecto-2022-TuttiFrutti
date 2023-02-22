@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<style>
    :root {
        --main-color: #4a76a8;
    }

    .bg-main-color {
        background-color: var(--main-color);
    }

    .text-main-color {
        color: var(--main-color);
    }

    .border-main-color {
        border-color: var(--main-color);
    }
</style>
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <div class="container mx-auto my-5 p-5">
        <div class="md:flex justify-center no-wrap md:-mx-2 mb-10">
           
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
            <div class="w-full md:w-9/12 mx-2 h-64">
                
                <div class="bg-white p-3 shadow-sm rounded-sm">
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                        <span clas="text-green-500">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="tracking-wide">Informacion de usuario</span>
                    </div>
                    <div class="text-gray-700">
                        <div class="grid md:grid-cols-2 text-sm">
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Nombre</div>
                                <div class="px-4 py-2">{{$user->name}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Apellido</div>
                                <div class="px-4 py-2">{{$user->surname}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Email</div>
                                <div class="px-4 py-2">{{$user->email}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Teléfono</div>
                                <div class="px-4 py-2">{{$user->phone}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Direccion</div>
                                <div class="px-4 py-2">{{$user->client->address->address}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Pedidos Realizados</div>
                                <div class="px-4 py-2">{{count($user->sales)}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Valor total de pedidos realizados</div>
                                @php
                                $total = 0;
                                    foreach ($user->sales as $sale) {
                                        $total += $sale->total;
                                    }
                                @endphp
                                <div class="px-4 py-2">${{$total}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Registrado desde:</div>
                                <div class="px-4 py-2">{{$user->created_at}}</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('client.profile.edit')}}">
                    <button
                        class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Editar Perfil</button></a>
                </div>
                <!-- End of about section -->

                <!-- End of profile tab -->
            </div>
        </div>
    </div>


@endsection