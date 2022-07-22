@props(['product'])
<x-card-component>

@php
    $category = App\Models\Category::find($product['category_id']);
    $category = $category['name'];
    $text = "";
    switch ($category) {
        case 'Fruta':
            $text='text-danger';
            break;
        case 'Verdura':
            $text='text-success';
        default:
            "text-primary";
            break;
    }
    
@endphp


    <a href="/products/{{$product['id']}}"><img src="img/metallica.png" class="card-img-top" alt=""></a>
    
    <div class="card-body">
    
        <a class=" text-decoration-none" href="/products/{{$product['id']}}">
            <h2 class="text-center card-title">{{$product['name']}}</h2>
            <h6 class="card-subtitle mb-2 {{$text}}">{{$category}}</h6>
        </a>
    <p class="card-text text-black">{{$product['description']}} Lorem ipsum dolor sit amet consectetur adipisicing elit. At, facilis!</p>

    </div>
</x-card-component>