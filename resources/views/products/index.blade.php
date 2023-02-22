@extends('layouts.app')

@section('content')
@if(session()->has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
      <span class="font-medium">{{ session()->get('success') }}</span> <a href="{{route('cart')}}" class="hover:text-blue-900"> Acceder al carrito </a>
    </div>
    @endif
<div class="d-flex flex-column align-items-center p-2 border border-info border-1 rounded-3">
    
    <div class=" container">
       @if ($error ?? false)
            <div class="d-flex justify-content-center p-5 m-5">
                <h3>
            {{$error}}
            </h3>
            </div>
        @else
        
        {{$products->links('vendor.pagination.tailwind')}}
        <section>
            <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 lg:px-8">
              <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:items-start">
                <div class="lg:sticky lg:top-4">
                  <details open class="overflow-hidden rounded border border-gray-200">
                    <summary
                      class="flex items-center justify-between bg-gray-100 px-5 py-3 lg:hidden"
                    >
                      <span class="text-sm font-medium"> Mostrar Filtros </span>
          
                      <svg
                        class="h-5 w-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"
                        />
                      </svg>
                    </summary>
                
                    {{-- Formulario --}}
                    <form method="" action="" class="border-t border-gray-200 lg:border-t-0">
                      @csrf
                      <fieldset>
                        <legend
                          class="block w-full bg-gray-50 px-5 py-3 text-xs font-medium"
                        >
                          Categoria
                        </legend>
          
                        <div class="space-y-2 px-5 py-6">
                          <div class="flex items-center">
                            <input
                              id="category_id1"
                              type="radio"
                              name="category_id"
                              value="1"
                              {{ request()->input('category_id')=="1" ? 'checked='.'"checked"' : '' }}
                              class="h-5 w-5 rounded border-gray-300"
                            />
          
                            <label for="category_id1" class="ml-3 text-sm font-medium">
                              Fruta
                            </label>
                          </div>
          
                          <div class="flex items-center">
                            <input
                              id="category_id2"
                              type="radio"
                              name="category_id"
                              value="2"
                              {{ request()->input('category_id')=="2" ? 'checked='.'"checked"' : '' }}
                              class="h-5 w-5 rounded border-gray-300"
                            />
          
                            <label for="category_id2" class="ml-3 text-sm font-medium">
                              Verdura
                            </label>
                          </div>
          
                          <div class="flex items-center">
                            <input
                              id="category_id3"
                              type="radio"
                              name="category_id"
                              value="3"
                              {{ request()->input('category_id')=="3" ? 'checked='.'"checked"' : '' }}
                              class="h-5 w-5 rounded border-gray-300"
                            />
          
                            <label for="category_id3" class="ml-3 text-sm font-medium">
                              Otro
                            </label>
                          </div>
          
                          <div class="pt-2">
                            <input type="button" value="Reiniciar Filtro" class="text-xs text-gray-500 underline" onclick="clearInput()">
                          </div>
                        </div>
                      </fieldset>
          
                      <div
                        class="flex justify-between border-t border-gray-200 px-5 py-3"
                      >
                      
                        <input
                          value="Limpiar filtros"
                          type="button"
                          onclick="this.form.reset();clearInput();this.form.submit()"
                          class="rounded text-xs font-medium text-gray-600 underline"
                        >
          
                        <button
                          
                          type="submit"
                          class="rounded bg-green-600 px-5 py-3 text-xs font-medium text-white"
                        >
                          Aplicar Filtros
                        </button>
                      </div>
                    




                  </details>
                </div>
          
                <div class="lg:col-span-3">
                  <div class="flex items-center justify-between">
                    {{-- <p class="text-sm text-gray-500">
                      <span class="hidden sm:inline"> Showing </span>
                      6 of 24 Products
                    </p> --}}
          
                    <div class="ml-4">
                      <label for="SortBy" class="sr-only"> Ordenar </label>
          
                      <select
                        id="sortBy"
                        name="sort_by"
                        class="rounded border-gray-100 text-sm"
                      >
                      @php
                      function selected($order){
                        if (request()->query('sort_by') == $order) {
                          echo "selected";
                        };
                      }
                      @endphp
                        <option readonly>Ordenar por</option>
                        <option value="name-asc"{{selected('name-asc')}}>Nombre, A-Z</option>
                        <option value="name-desc" {{ selected('name-desc') }}>Nombre, Z-A</option>
                        <option value="price-asc" {{ selected('price-asc') }}>Precio, Menor-Mayor</option>
                        <option value="price-desc" {{ selected('price-desc') }}>Precio, Mayor-Menor</option>
                      </select>
                    </div>
                  </div>
                </form>
                  <div
                    class="mt-4 grid grid-cols-1 gap-px border border-gray-200 bg-rose-400 sm:grid-cols-2 lg:grid-cols-3"
                  >
                  @foreach ($products as $product)
                      
                  
                    <div class="relative block bg-white ">
                      
                      <a href="{{route('products.show', ['product'=>$product])}}">
                      <img
                        alt="{{$product->name}}"
                        src="{{$product->image->url}}"
                        class="h-56 w-full object-contain lg:h-72"
                      />
                    </a>
                      <div class="p-6">
                        @switch($product->category->name)
                          @case('Fruta')
                          <span class="inline-block bg-red-400 px-3 py-1 text-xs font-medium">
                            {{$product->category->name}}
                          </span>
                            @break
                          @case('Verdura')
                          <span class="inline-block bg-emerald-400 px-3 py-1 text-xs font-medium">
                            {{$product->category->name}}
                          </span>
                            @break
                          @case('Otro')
                          <span class="inline-block bg-blue-400 px-3 py-1 text-xs font-medium">
                            {{$product->category->name}}
                          </span>
                            @break
                        
                          @default
                            
                        @endswitch
          
                        <a href="{{route('products.show', ['product'=>$product])}}">
                        <h3 class="mt-4 text-lg font-bold hover:text-blue-500">{{$product->name}}</h3>
                      </a>
                        <p class="mt-2 text-sm font-medium text-gray-600">${{$product->price}}</p>
      
                        <form id="" action="{{route('cart.add')}}" method="POST">
                        @csrf
                        <input name="product_id" type="hidden" value="{{$product->id}}">
                        <input type="hidden" name="quantity" value="1" min="1">
                        <button
                          type="submit"
                          class="mt-4 flex w-full items-center justify-center rounded-sm bg-amber-500 hover:bg-amber-400 px-8 py-4"
                        >
                            <span class="text-sm font-medium"> Añadir al Carrito </span>
                            
                            <svg
                            class="ml-1.5 h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            >
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
                            />
                          </svg>
                        </button>
                      </form>

                      </div>
                    </div>
                    @endforeach
                     
                  </div>
                </div>
              </div>
            </div>
          </section>
          @endif  
          
          <script>
            window.addEventListener('resize', () => {
              const desktopScreen = window.innerWidth < 768
          
              document.querySelector('details').open = !desktopScreen
            })
          </script>
          
        
    </div>
</div>
{{$products->links('vendor.pagination.tailwind')}}
<script>
  function clearInput(){
    $('input[name=category_id]').prop('checked',false);
    try {
            document.getElementById('sortBy').selectedIndex = 0; 
            } catch (error){}
  }

</script>
@endsection