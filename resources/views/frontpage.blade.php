<x-partials.htmlhead/>


<body class="antialiased" style="background-color: #C3CCE9">
     <x-navbar-component action="/"/>

     <div class="d-flex py-5 justify-content-center text-light ">

            <div class="d-flex flex-column align-items-center">
            
                <div style="display: flex; align-items:center; justify-content:center" class="w-100">
                    
                    <div style="height:37.031px; width:139.948px;margin-right:auto"></div>
                    <div style="display: flex; justify-content:center;">
                    <x-partials.hero />
                    </div>
                    <div class="btn-group" style="display:flex;justify-content:flex-end;align-items:center;margin-left:auto">
                        <a role="button" class="btn btn-dark" href="/admin/products/create">Create</a>
                        <a role="button" class="btn btn-dark" href="/admin">Admin</a>
                    </div>
                </div>
                <img src="/img/logo2.png" width="100" height="100">
                <p>Lorem ipsum s dolor sit amet consectetur adipisicing elit. Vero corrupti ipsum est atque voluptas
                    molestias quaerat doloribus tenetur magnam nesciunt.
                </p>
                
                <div id="controls-carousel" class="relative" data-carousel="static">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
         <!-- Item 1 -->
        <div class="duration-700 ease-in-out absolute inset-0 transition-all transform -translate-x-full z-10" data-carousel-item="">
            <img src="/img/banner.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 2 -->
        <div class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0 z-20" data-carousel-item="active">
            <img src="/img/banner2.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 3 -->
        <div class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-full z-10" data-carousel-item="">
            <img src="/img/banner3.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev="">
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-6 h-6 text-white dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next="">
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-6 h-6 text-white dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

                    
                <div class="d-flex pt-5 justify-content-center btn-group mb-3">

                    <a href="/"><button class="btn-dark">Todo</button></a>

                    <a href="?category_id=1"><button class="btn-dark">Frutas</button></a>
            
                    <a href="?category_id=2"><button class="btn-dark">Verduras</button></a>

                    <a href="?category_id=3"><button class="btn-dark">Otro</button></a>
                </div> 
                
                <div class=" container">
                   @if ($error ?? false)
                        <div class="d-flex justify-content-center p-5 m-5">
                            <h3>
                        {{$error}}
                        </h3>
                        </div>
                    @else
                    <div class="row row-cols-2 row-cols-md-4 g-4">
                        
                        <x-products-component :products="$products" />
                        

                    </div>
                    @endif
                    
                </div>
                    
                
                
            </div>
            
        </div>
        {{-- Paginacion --}}
        @if ($error ?? false)
                        
        @else                        
        <div class="container">
            {{$products->links()}}
        </div>
        @endif
        <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js" ></script>
</body>

</html>

