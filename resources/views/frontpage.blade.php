<x-partials.htmlhead/>

{{-- style="background-color: #1a202c" --}}
<body class="antialiased">
     <x-navbar-component action="/"/>

     <div class="d-flex justify-content-center text-white" style="background-color: #093a4b">

            <div class="d-flex flex-column align-items-center" >
            
                
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
    
</body>

</html>

