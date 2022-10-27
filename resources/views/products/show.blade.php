@extends('layouts.app')

@section('content_header')

    <h1 class="aling-center">Productos - Index</h1>
    @stop
    
    @section('content')
    
    <style>
.responsive {
  width: 100%;
  max-width: 500px;
  height: auto;
}
  .button {
  background-color: #000000; /* color blue */
  border: none;
  color: white;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.button3 {border-radius: 8px;}
.button3 {padding: 14px 40px;}

</style>
<body class="antialiased" style="background-color: #C3CCE9">
<div class="container">
<div class="row" style="background-color:#FFFAF0">
<div class="col-md-7 col-xs-12">
  <table class="table" >
  <img src="/img/metallica.png" width="500" height="350" class="responsive" >
  </table>
</div>
  <div class="col-md-5 col-xs-12">
  <br>
    <div class="information">
      <div class="summary entry-summary">
        <h1 class="product_name">{{ $product['name'] }}</h1>
      
      </div>
      <div class='delivery_info'>
        <i class="ti-truck"></i>DELIVERY GRATIS</div>
        <div class="price-rating-wrapper clearfix">
          <p class="price"><span class="price-prefix">Kilogramo:</span><span class="woocommerce-Price-amount amount"><bdi>4,99&nbsp;<span class="simbolo-peso">&dollar;</span></bdi></span></p>
          <p id="must_select_text" style="color: red;font-weight: 600;font-size: 20px;">Debe seleccionar kg o unidad</p>
        </div>
        <form class="unidad-venta">
          <div class="unidad-venta">
                <table>
                  <tbody>
                    <tr>
                    <th class="label"><label for="pa_formato">Formato</label></th>
                    <td class="value">
                      <div class="variation-selector variation-select-label hidden">
                      <select id="pa_formato" class="" name="attribute_pa_formato" data-attribute_name="attribute_pa_formato" data-show_option_none="yes"><option value="">Elige una opción</option>
                      <option value="kg" >Kg</option>
                      <option value="unidad" >Unidad</option>
                    </select></div>
                    <div class="tawcvs-swatches oss-" data-attribute_name="attribute_pa_formato">
                      <div class="swatch-item-wrapper"><div class="swatch swatch-shape-circle swatch-label swatch-kg " data-value="kg"><span class="text">Kg</span></div>
                    </div><div class="swatch-item-wrapper">
                      <div class="swatch swatch-shape-circle swatch-label swatch-unidad " data-value="unidad">
                        <span class="text">Unidad</span></div></div></div><a class="reset_variations" href="#">Limpiar</a>
                    </tr>
                  </tbody>
                </table>        
          </div>
        </div>
        <div class="container">
            <button class="button button3">comprar</button>
            </div>
  </div>
  
</div>
</div>

</body>

 
   

    @stop
    

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop