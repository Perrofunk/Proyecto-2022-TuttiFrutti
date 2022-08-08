<x-partials.htmlhead/>


<body class="antialiased" style="background-color: #1a202c">
     <x-navbar-component action="/"/>

     <div class="d-flex py-5 justify-content-center bg-success text-white">
        

            <div class="d-flex flex-column align-items-center">
            
                <div style="display: flex; align-items:center; justify-content:center" class="w-100">
                    
                    <div style="height:37.031px; width:139.948px;margin-right:auto"></div>
                    <div style="display: flex; justify-content:center;">
                    <x-partials.hero />
                    </div>
                    <div style="display:flex;justify-content:flex-end;align-items:center;margin-left:auto">
                        <a role="button" class="btn btn-secondary" href="/admin/products/create">Create</a>
                        <a role="button" class="btn btn-secondary" href="/admin">Admin</a>
                    </div>
                </div>
                <p>Lorem ipsum s dolor sit amet consectetur adipisicing elit. Vero corrupti ipsum est atque voluptas
                    molestias quaerat doloribus tenetur magnam nesciunt.</p>
                    @if ($error ?? false)
                        
                    @else                        
                        {{-- <x-carousel-component :products="$products"/> --}}
                    @endif
                    

                <div class="d-flex pt-5 justify-content-center btn-group mb-3">

                    <a href="/"><button class="btn-light">Todo</button></a>

                    <a href="?category_id=1"><button class="btn-light">Frutas</button></a>
            
                    <a href="?category_id=2"><button class="btn-light">Verduras</button></a>

                    <a href="?category_id=3"><button class="btn-light">Otro</button></a>
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
</body>

</html>

