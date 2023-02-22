@props(['products'])
<section>
    <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 lg:px-8">
      <div
        class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 lg:items-stretch"
      >
        <div class="flex justify-center items-center rounded bg-gray-100 p-8">
          <div class="mx-auto text-center">
            <h2 class="text-2xl font-bold">Nuestros Productos</h2>
  
            <p class="mt-4 max-w-[45ch] text-sm text-gray-700">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos,
              cupiditate mollitia saepe vitae libero nobis.
            </p>
  
            <a
              href="{{route('products.index')}}"
              class="mt-6 inline-block rounded bg-violet-800 text-white px-6 py-3 text-sm"
            >
              Explorar
            </a>
          </div>
        </div>
  
        <div class="grid grid-cols-2 gap-4 lg:col-span-2 lg:grid-cols-3 lg:py-12">
          @foreach ($products as $product)
          @if ($loop->index === 3)
            @break
          @endif
          <a href="{{route('products.show', ['product'=>$product])}}" class="block">
            <img
              alt="{{$product->name}}"
              src="/{{$product->image->url}}"
              class="aspect-square w-full rounded object-cover"
            />
  
            <div class="mt-2">
              <h3 class="font-medium">{{$product->name}}</h3>
  
              <p class="mt-1 text-sm text-gray-700">${{$product->price}}</p>
            </div>
          </a>
          @endforeach
        </div>
      </div>
    </div>
  </section>