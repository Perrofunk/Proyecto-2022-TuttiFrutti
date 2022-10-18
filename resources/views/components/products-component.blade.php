{{-- props es basicamente una variable que se usa para los componentes de blade. Cuando se utiliza el componente en otro archivo, se define la variable.
    
    Supongamos que estamos en la vista HOME:
    <body>
        <h1>Lorem ipsum dolor sit amet</h1>
        <x-products-component :products="$products" />
    </body>

    En este caso decimos que, (importante prestar atencion a los simbolos) 'products' es igual a $products (variable que desde el controller pasamos a la vista, y que contiene la coleccion de datos de la Base de datos).
    --}}
@props(['products'])
@php
    use Illuminate\Support\Facades\Route;
    $prefix = Route::current()->action['prefix'];
    $count = 0;
@endphp
<!--
    Ahora que ya tenemos $products en este archivo (usando props, lo pasamos desde la vista [que a su vez se pasa desde el controller] hasta aca), podemos trabajar con esta variable. 

    La variable $products guarda una Coleccion de Objetos proveniente de la base de datos (cada producto es un Objeto). Cada Objeto tiene sus Propiedades, como ID, Name, Description.

    $products al ser una Coleccion de Objetos, no permite acceder a las propiedades de un Objeto individual, por eso tenemos que iterar sobre cada Objeto y guardarlo en una variable que por convencion es el singular de nuestra coleccion (si nuestra coleccion se llama $products, su singular es $product), para despues poder hacer esto: $product['id']. Si esto mismo lo intentamos con la coleccion: $products['id'] Nos da error, porque no esta buscando la Propiedad ID de un Objeto, sino que esta buscando un Objeto de nombre ID en la coleccion. Si no se entiende avisen.

    Ahora utilizando foreach vamos a iterar sobre la coleccion, guardando cada objeto en una variable y ejecutando el codigo para cada objeto individual. Todo el codigo que sigue, desde el foreach hasta el endforeach, se repite para cada objeto de la coleccion.
-->
@foreach ($products as $product)
@php
    $count += 1;
@endphp
    {{-- Se utiliza un componente "wrapper" <x-card-component /> para encerrar el codigo en dos divs, uno que le asigna una columna, y otro que le asigna la clase "card" --}}
<x-card-component>
    
    
    @php
    
        /*  Busca en la tabla de categorias -> segun el ID de categoria del    producto -> el nombre de la categoria. Lo guarda en la variable $category, que luego se usa para mostrar el nombre de la categoria como subtitulo en la carta de producto (h6 card-subtitle)    */


    $category = App\Models\Category::find($product['category_id']);
    $category = $category['name'];

/*
    Define la variable $textColor. Esta se usa para cambiar el color del texto en el subtitulo, dependiendo de la categoria. En el switch se evalua si el nombre de la categoria es fruta, verdura, otro, o ninguno. Si es fruta, rojo, si es verdura, verde, si es otro, azul, y si no es ninguno de los anteriores, gris.
*/

    $textColor = "";
    switch ($category) {
        case 'Fruta':
            $textColor='text-danger';//Texto color Rojo
            break;
        case 'Verdura':
            $textColor='text-success';//Texto color Verde
            break;
        case 'Otro':
            $textColor="text-primary";//Texto color Azul
            break;
        default:
            $textColor="text-muted";//Texto gris
    }
    
    
@endphp

{{-- Cuando el foreach recorre la coleccion y guarda el objeto individual en la variable $product se hace posible acceder a sus propiedades, como 'id' y 'name'. --}}
    <a href="{{$prefix}}/products/{{$product->id}}"><img src="/{{ $product->image->url}}"  class="card-img-top" alt=""></a>
    
    <div class="card-body">
    
        <a class=" text-decoration-none" href="{{$prefix}}/products/{{$product->id}}">
            <h4 class="text-center card-title">{{$product->name}}</h4>
            <h6 class="card-subtitle mb-2 {{$textColor}}">{{$product->category->name}}</h6>
        </a>
    <p class="card-text text-black"><strong>${{$product->price}}</strong></p>

    </div>
    
</x-card-component>
@endforeach
@if ($count == 1)
<script>
    document.getElementById('product-list').firstElementChild.classList.add('w-50');
</script>
@endif