@extends('layouts.app')

@section('content')
<div class="d-flex flex-column align-items-center p-2 border border-info border-1 rounded-3">
    
    <div class=" container">
       @if ($error ?? false)
            <div class="d-flex justify-content-center p-5 m-5">
                <h3>
            {{$error}}
            </h3>
            </div>
        @else
        
        {{$products->links('pagination::tailwind')}}
        <section>
            <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 lg:px-8">
              <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:items-start">
                <div class="lg:sticky lg:top-4">
                  <details open class="overflow-hidden rounded border border-gray-200">
                    <summary
                      class="flex items-center justify-between bg-gray-100 px-5 py-3 lg:hidden"
                    >
                      <span class="text-sm font-medium"> Toggle Filters </span>
          
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
                  
                    <form method="POST" action="" class="border-t border-gray-200 lg:border-t-0">
                      <fieldset>
                        <legend
                          class="block w-full bg-gray-50 px-5 py-3 text-xs font-medium"
                        >
                          Categoria
                        </legend>
          
                        <div class="space-y-2 px-5 py-6">
                          <div class="flex items-center">
                            <input
                              id="category_id"
                              type="checkbox"
                              name="category_id"
                              class="h-5 w-5 rounded border-gray-300"
                            />
          
                            <label for="category_id" class="ml-3 text-sm font-medium">
                              Fruta
                            </label>
                          </div>
          
                          <div class="flex items-center">
                            <input
                              id="game"
                              type="checkbox"
                              name="category_id"
                              class="h-5 w-5 rounded border-gray-300"
                            />
          
                            <label for="game" class="ml-3 text-sm font-medium">
                              Verdura
                            </label>
                          </div>
          
                          <div class="flex items-center">
                            <input
                              id="outdoor"
                              type="checkbox"
                              name="type[outdoor]"
                              class="h-5 w-5 rounded border-gray-300"
                            />
          
                            <label for="outdoor" class="ml-3 text-sm font-medium">
                              Otro
                            </label>
                          </div>
          
                          <div class="pt-2">
                            <button type="button" class="text-xs text-gray-500 underline">
                              Reiniciar filtro
                            </button>
                          </div>
                        </div>
                      </fieldset>
          
                      <div
                        class="flex justify-between border-t border-gray-200 px-5 py-3"
                      >
                        <button
                          name="reset"
                          type="button"
                          class="rounded text-xs font-medium text-gray-600 underline"
                        >
                          Limpiar Todos los Filtros
                        </button>
          
                        <button
                          name="commit"
                          type="button"
                          class="rounded bg-green-600 px-5 py-3 text-xs font-medium text-white"
                        >
                          Aplicar Filtros
                        </button>
                      </div>
                    </form>
                  </details>
                </div>
          
                <div class="lg:col-span-3">
                  <div class="flex items-center justify-between">
                    {{-- <p class="text-sm text-gray-500">
                      <span class="hidden sm:inline"> Showing </span>
                      6 of 24 Products
                    </p> --}}
          
                    <div class="ml-4">
                      <label for="SortBy" class="sr-only"> Sort </label>
          
                      <select
                        id="SortBy"
                        name="sort_by"
                        class="rounded border-gray-100 text-sm"
                      >
                        <option readonly>Sort</option>
                        <option value="title-asc">Title, A-Z</option>
                        <option value="title-desc">Title, Z-A</option>
                        <option value="price-asc">Price, Low-High</option>
                        <option value="price-desc">Price, High-Low</option>
                      </select>
                    </div>
                  </div>
          
                  <div
                    class="mt-4 grid grid-cols-1 gap-px border border-gray-200 bg-gray-200 sm:grid-cols-2 lg:grid-cols-3"
                  >
                  @foreach ($products as $product)
                      
                  
                    <div class="relative block bg-white">
                      
                      <a href="{{route('products.show', ['product'=>$product])}}">
                      <img
                        alt="{{$product->name}}"
                        src="{{$product->image->url}}"
                        class="h-56 w-full object-contain lg:h-72"
                      />
                    </a>
                      <div class="p-6">
                        <span class="inline-block bg-yellow-400 px-3 py-1 text-xs font-medium">
                          {{$product->category->name}}
                        </span>
          
                        <a href="{{route('products.show', ['product'=>$product])}}">
                        <h3 class="mt-4 text-lg font-bold hover:text-blue-500">{{$product->name}}</h3>
                      </a>
                        <p class="mt-2 text-sm font-medium text-gray-600">${{$product->price}}</p>
          
                        <button
                          type="button"
                          class="mt-4 flex w-full items-center justify-center rounded-sm bg-green-500 px-8 py-4"
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
                      </div>
                    </div>
                    @endforeach
                     
                  </div>
                </div>
              </div>
            </div>
          </section>
          @endif  
          {{$products->links('pagination::tailwind')}}
          <script>
            window.addEventListener('resize', () => {
              const desktopScreen = window.innerWidth < 768
          
              document.querySelector('details').open = !desktopScreen
            })
          </script>
          
        
    </div>
</div>
@endsection
