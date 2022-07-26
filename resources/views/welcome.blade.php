<x-partials.htmlhead/>


<body class="antialiased" style="background-color: #1a202c">
    <x-navbar-component/>

        <div class="d-flex py-5 justify-content-center bg-success text-white">

            <div class="d-flex flex-column align-items-center">
                <x-partials.hero />
                <p>Lorem ipsum s dolor sit amet consectetur adipisicing elit. Vero corrupti ipsum est atque voluptas
                    molestias quaerat doloribus tenetur magnam nesciunt.</p>

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
                    
                    
                </div>
                    
                @endif
                
            </div>
            
        </div>
        {{-- Paginacion --}}
        <div class="container">
                {{$products->links()}}
                </div>
</body>

</html>
