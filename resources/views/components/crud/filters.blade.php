@props(['variable', 'relacion'=>"", 'relacion_modelos'=>""])
@php

// $availableFilters = $variable->getCollection()->first()->availableFilters;
// if (is_null($availableFilters)) {
//   echo "Variable availableFilters no definida en el modelo {{$variable->getCollection()->first()->getTable()}}";
// }

$columns = array_keys($variable->first()->getAttributes());
$columns = array_diff($columns, ['created_at', 'updated_at']);
$relacion_id = null;
if ($relacion_modelos != "") {
    if (($relacion_modelos->first()->getTable()) === "categories") {
        $relacion_plural = $relacion_modelos->first()->getTable();
        $relacion = rtrim($relacion_plural, 'ies') ."y";
    }else {
        $relacion_plural = $relacion_modelos->first()->getTable();
        $relacion = rtrim($relacion_plural, 's');
    }
    $relacion_id = $relacion . "_id";
    $columns = array_diff($columns, [$relacion_id]);
}
function selected($item, $relacion_id = 'orderBy'){
  if (request()->query($relacion_id) == $item) {
    echo "selected";
  };
}
$requestInput = request()->input();
                
                array_splice($requestInput, array_search('orderDirection', $requestInput)-1, 1);
                $requestInput = array_unique($requestInput);
                if (array_key_exists('search', $requestInput)) {
                  if ($requestInput['search'] == null) {
                    array_splice($requestInput, 1, 1);
                  }
                }
              
              function showFilters($requestInput, $relacion_modelos){
                if (count($requestInput) <= 1) {
                   echo "<span class='text-muted'>No hay filtros activos</span>"; 
                  }else{
                    echo "<small class=''>Filtros activos: </small><br>";
                  foreach ($requestInput as $key => $value) {
                    if (is_null($value) || $key == "_token") {
                      continue;
                    }
                    if (preg_match('/(_id)/', $key)) {
                      $key = rtrim($key, '_id');
                      echo ucfirst(__($key)).": " ."<span class='text-bold'>".ucfirst(__($relacion_modelos->where('id', $value)->first()->name)) . "</span><br>";
                    } else{echo ucfirst(__($key)) . ": "."<span class='text-bold'>". __($value) . "</span><br>";}
                    }
                  };
              }
              @endphp

<div x-data="{ card: $persist(true), table: $persist(false) }">
    <div class="row">
        <div class="col">
            
        </div>
        <div class="col ">
                <h2 class="">
                    {{$slot}}
            </h2>
        </div>
        <div class="col">
        </div>
    </div>

<div class="row mb-2">
<form id="filterForm" class="" method="" action="">
    @csrf
    
    <div class="input-group-text">
        <label class="form-label" for="form1"></label>
        <input type="text" name="search" id="filterFormSearch" class="" />
        <button class="btn btn-outline-primary border-0 rounded-0" type="submit">Search</button>
    </div>
      @if ($relacion_id != null)
      <div class="input-group mb-1">
          <label class="input-group-text" for="inputGroupSelect01">{{ucfirst(__($relacion))}}</label>
          <select name="{{$relacion_id}}" class="form-select" id="inputGroupSelect01">
            <option aria-placeholder="Seleccionar..." value="">
            Seleccionar...
             </option>
             @foreach ($relacion_modelos as $relacion_item)    
              <option value="{{$relacion_item->id}}" {{selected($relacion_item->id, $relacion_id)}}>{{ucfirst(__($relacion_item->name))}}</option>
             @endforeach
          </select>
        </div>
      @endif
    <div class="input-group">
        <label class="input-group-text" for="inputGroupSelect02">Ordenar por</label>
        <select name="orderBy" class="form-select" id="inputGroupSelect02">
          <option aria-placeholder="Seleccionar..." value="">Seleccionar...</option>
          @php
              $invalid = ['email', 'contact', 'address', 'phone', 'user_id'];
          @endphp
          @foreach ($columns as $column)
                @if (!in_array($column, $invalid))
                <option value="{{$column}}" {{selected($column)}}>{{__($column)}}</option>
                @endif
          @endforeach
        </select>
      </div>
      <div class="row mt-3 ms-2">
        <div class="col d-flex flex-column justify-content-center">
          <div class="form-check">
            @php
                $value = true;
              function checkbox($value){
                if (request()->input('orderDirection') == "asc" || is_null(request()->input('orderDirection'))){
                  $value = $value;
                } else {
                  $value = !$value;
                }
                if ($value == true) {
                  return "checked";
                }
              }
            @endphp
            <input class="form-check-input" value="asc" type="radio" name="orderDirection" id="flexRadioDefault1" {{checkbox($value)}}>
            <label class="form-check-label" for="flexRadioDefault1">
              Ascendente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="desc" type="radio" name="orderDirection" id="flexRadioDefault2" {{checkbox(!$value)}}>
            <label class="form-check-label" for="flexRadioDefault2">
              Descendente
            </label>
          </div>
        </div>
        <div class="col-3 d-flex align-items-center">
          <div class="btn-group">
            <button class="btn btn-primary" type="submit">Aplicar</button>
            <button class="btn btn-secondary" type="button" onclick="event.preventDefault()
            document.getElementById('filterFormSearch').value=null;
            try {
            document.getElementById('inputGroupSelect01').selectedIndex = 0; 
            } catch (error){}
            try {
            document.getElementById('inputGroupSelect02').selectedIndex = 0;
            } catch(error){}
            document.getElementById('filterForm').submit();
            ">Limpiar</button>
          </div>
          </div>
          <div class="col-6">
            
            <p class="m-0">{{showFilters($requestInput, $relacion_modelos)}}</p>
          </div>
            </div>
  </form>
  
</div>