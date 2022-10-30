@extends('adminlte::master')
<x-partials.htmlhead/>


<body class="antialiased" style="background-color: #C3CCE9">
     <x-navbar-component action="/"/>

     <div class="d-flex py-5 justify-content-center text-light ">

            <div class="d-flex flex-column align-items-center">
            
                <?php 
                    
                use App\Models\Admin;    
                use App\Models\User;
                use App\Models\Client;
                use App\Models\Product;

                
                ?>

                    <x-partials.hero />
                    </div>
                    <div class="btn-group" style="display:flex;justify-content:flex-end;align-items:center;margin-left:auto">
                        <a role="button" class="btn btn-dark" href="/admin/products/create">Create</a>
                        <a role="button" class="btn btn-dark" href="/admin">Admin</a>
                    </div>
                </div>
                <img src="/img/logo2.png" width="300" height="300">
                <p class=" text-xl">Tu verduleria de confianza
                </p>  

                <style>
* {box-sizing: border-box;}
body {font-family: Verdana, sans-serif;}
.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Caption text */
.text1 {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 4s;
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
</style>
</head>
<body>
<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="img/banner.png" style="width:100%">
  <div class="text1"></div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="img/banner2.png" style="width:100%">
  <div class="text1"></div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="img/banner3.png" style="width:100%">
  <div class="text1"></div>
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 4000); // Change image every 2 seconds
}
</script>

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
        <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js" ></script>
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

