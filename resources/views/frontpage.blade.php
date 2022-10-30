@extends('adminlte::master')
<x-partials.htmlhead/>

{{-- style="background-color: #1a202c" --}}
<body class="antialiased">
    
     <x-navbar-component action="/"/>

     <div class="d-flex py-5 justify-content-center bg-gradient-green text-white" style="background-color: #093a4b">
        
            <div class="d-flex flex-column align-items-center" >
            
                <?php 
                    
                use App\Models\Admin;    
                use App\Models\User;
                use App\Models\Client;
                use App\Models\Product;

                
                ?>

                    <x-partials.hero />
                    
                
                    
                    @if ($error ?? false)
                        
                    @else                        
                        {{-- <x-carousel-component :products="$products"/> --}}
                    @endif
                    

            <div class="d-flex flex-column align-items-center p-2 border border-info border-1 rounded-3" style=" ;background-color: #092d4b">
                {{-- <div class=" text-center btn-group-vertical">
                    <div class="container-fluid m-0 p-0 ">
                    <a href="/"><button class="rounded-0 rounded-top btn btn-light w-100">Todo</button></a>
                    </div>
                    <div class="d-flex pt-1 justify-content-center mb-3">
                         <div class="btn-group">
                        <a href="?category_id=1"><button class="rounded-0 btn btn-danger ">Frutas</button></a>
                        <a href="?category_id=2"><button class="rounded-0 btn btn-success">Verduras</button></a>
                        <a href="?category_id=3"><button class="rounded-0 btn btn-primary">Otro</button></a>
                        
                        </div>
                    </div> 
                </div> --}}
                <div class=" container">
                   @if ($error ?? false)
                        <div class="d-flex justify-content-center p-5 m-5">
                            <h3>
                        {{$error}}
                        </h3>
                        </div>
                    @else
                    
                    <div id="product-list" class="row row-cols-2 row-cols-md-6 g-2 justify-content-center ">
                        
                        <x-products-component :products="$products" />
                        

                    </div>
                    @endif
                    
                </div>
            </div>

        </div>
            
        </div>
        {{-- Paginacion --}}
        @if ($error ?? false)
                        
        @else                        
        <div class="container">
            {{-- {{$products->links()}} --}}
        </div>
        @endif
        <section>
            <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 lg:px-8">
              <div
                class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 lg:items-stretch"
              >
                <div class="flex items-center rounded bg-gray-100 p-8">
                  <div class="mx-auto text-center lg:text-left">
                    <h2 class="text-2xl font-bold">Watches</h2>
          
                    <p class="mt-4 max-w-[45ch] text-sm text-gray-700">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos,
                      cupiditate mollitia saepe vitae libero nobis.
                    </p>
          
                    <a
                      href="#"
                      class="mt-6 inline-block rounded bg-black px-6 py-3 text-sm text-white"
                    >
                      View the Range
                    </a>
                  </div>
                </div>
          
                <div class="grid grid-cols-2 gap-4 lg:col-span-2 lg:grid-cols-3 lg:py-12">
                  <a href="#" class="block">
                    <img
                      alt="Simple Watch"
                      src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1598&q=80"
                      class="aspect-square w-full rounded object-cover"
                    />
          
                    <div class="mt-2">
                      <h3 class="font-medium">Simple Watch</h3>
          
                      <p class="mt-1 text-sm text-gray-700">$150</p>
                    </div>
                  </a>
          
                  <a href="#" class="block">
                    <img
                      alt="Simple Watch"
                      src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1598&q=80"
                      class="aspect-square w-full rounded object-cover"
                    />
          
                    <div class="mt-2">
                      <h3 class="font-medium">Simple Watch</h3>
          
                      <p class="mt-1 text-sm text-gray-700">$150</p>
                    </div>
                  </a>
          
                  <a href="#" class="block">
                    <img
                      alt="Simple Watch"
                      src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1598&q=80"
                      class="aspect-square w-full rounded object-cover"
                    />
          
                    <div class="mt-2">
                      <h3 class="font-medium">Simple Watch</h3>
          
                      <p class="mt-1 text-sm text-gray-700">$150</p>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </section>
          
        
</body>

</html>

