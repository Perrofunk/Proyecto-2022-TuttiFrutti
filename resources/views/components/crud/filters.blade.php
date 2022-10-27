@props(['variable', 'relacion'=>"", 'relacion_modelos'=>""])
@php
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


@endphp
<div x-data="{ card: $persist(true), table: $persist(false) }">
    <div class="row">
        <div class="col">
            <p class="text-secondary">
                Mostrando {{$variable->count()}} resultados.
            </p>
        </div>
        <div class="col ">
                <h2 class="" style="display: flex; justify-content:space-evenly">
                    {{$slot}}
            </h2>
        </div>
        <div class="col">
        </div>
    </div>

<div class="row mb-2">
<form class="" method="" action="">
    @csrf
    <legend>Filtros</legend>
    <div class="input-group-text">
        <label class="form-label" for="form1"></label>
        <input type="text" name="search" id="form1" class="" />
        <button class="btn btn-outline-primary border-0 rounded-0" type="submit">Search</button>
      </div>
      @if ($relacion_id != null)
      <div class="input-group mb-3">
          <label class="input-group-text" for="inputGroupSelect01">{{__($relacion)}}</label>
          <select name="{{$relacion_id}}" class="form-select" id="inputGroupSelect01">
            <option aria-placeholder="Seleccionar..." value="">
            Seleccionar...
             </option>
             @foreach ($relacion_modelos as $relacion_item)    
              <option value="{{$relacion_item->id}}">{{$relacion_item->name}}</option>
             @endforeach
          </select>
        </div>
      @endif
    <div class="input-group">
        <label class="input-group-text" for="inputGroupSelect02">Ordenar por</label>
        <select name="orderBy" class="form-select" id="inputGroupSelect02">
          <option aria-placeholder="Seleccionar..." value="">Seleccionar...</option>
          @php
              $invalid = ['email', 'contact', 'address', 'phone'];
          @endphp
          @foreach ($columns as $column)
                @if (!in_array($column, $invalid))
                <option value="{{$column}}">{{__($column)}}</option>
                @endif
          @endforeach
        </select>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-check">
            <input class="form-check-input" value="asc" type="radio" name="order" id="flexRadioDefault1" checked>
            <label class="form-check-label" for="flexRadioDefault1">
              Ascendente
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="desc" type="radio" name="order" id="flexRadioDefault2">
            <label class="form-check-label" for="flexRadioDefault2">
              Descendente
            </label>
          </div>
        </div>
        <div class="col d-flex align-items-center">
            <button class="btn btn-primary" type="submit">Aplicar</button>
          </div>
          <div class="col">
          </div>
            </div>
  </form>