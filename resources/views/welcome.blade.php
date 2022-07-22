@extends('partials._htmlhead')

<body class="antialiased" style="background-color: #1a202c">
    <x-navbar-component/>
        <div class="d-flex py-5 justify-content-center bg-success text-white">

            <div class="d-flex flex-column align-items-center">
                @include('partials._hero')
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero corrupti ipsum est atque voluptas
                    molestias quaerat doloribus tenetur magnam nesciunt.</p>

                <div class=" container">
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        <!--
                                Aca tenemos la variable $products, que guarda una Coleccion de Objetos proveniente de la base de datos (cada producto es un Objeto). Cada Objeto tiene sus Propiedades, como ID, Name, Description.
                                $products al ser una Coleccion de Objetos, no permite acceder a las propiedades de un Objeto individual, por eso tenemos que iterar sobre cada Objeto y guardarlo en una variable, para despues poder hacer esto: $product['id']. Si esto mismo lo intentamos con la coleccion: $products['id'] Nos da error, porque no esta buscando la Propiedad ID de un Objeto, sino que esta buscando un Objeto de nombre ID en la coleccion. Si no se entiende avisen.
                        -->
                        @foreach ($products as $product)
                            <x-products-component :product="$product" />
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
