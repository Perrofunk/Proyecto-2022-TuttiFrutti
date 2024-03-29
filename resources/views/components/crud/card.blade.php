@props(['variable', 'relacion'=>"", 'parent'=>'', 'ruta'])

@php

use Illuminate\Database\Eloquent\Model;
if ($parent != '') {
    $parent_table = $parent->getTable();
    $parent_singular = rtrim($parent_table, 's');
}

$variable_table = $variable->first()->getTable();
$variable_singular = rtrim($variable_table, 's');
$ruta_edit = $ruta . ".edit";
  $ruta_destroy = $ruta . ".destroy";
  $ruta_singular = rtrim($ruta, "s");
  $ruta_show = $ruta .".show";
  $relacion_show = $relacion . "s.show";
  $relacion_id = $relacion . "_id";
  if ($relacion === "category") {
    $relacion_show = rtrim($relacion, "y") . "ies.show";
  }
  $columns = array_keys($variable->first()->getAttributes());
  $columns = array_diff($columns, ['id', $relacion_id, 'created_at', 'updated_at']);
  array_splice($columns, 3, 4);
@endphp

@foreach ($variable as $item)
<x-card-component class="border border-dark">
    
    @if (preg_match('/(_details)/', $variable_table))
    <h2 class="text-center bg-dark card-header">ID {{ __($item->id) }}</h2>
    @else   
    <a class="text-decoration-none" href="{{route($ruta_show, [$variable_singular => $item])}}"><h2 class="text-center bg-dark card-header">ID {{ __($item->id) }}</h2></a>
    @endif
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @if ($variable_table == "sales")
            
            <li class="list-group-item text-center text-secondary">Usuario 
                <a href="{{route('users.show', ['user'=>$item->user->id])}}"><p  class="">{{$item->user->name}}</p></a>
            </li>
            @endif
            @foreach ($columns as $column)    
                <li class="list-group-item text-center text-secondary">{{__($column)}}: 
                    <p class="text-dark text-bold">{{ $item[$column] }}</p>
                </li>
            @endforeach
            @if ($relacion != "")
                <li class="list-group-item text-center text-secondary">{{__($relacion)}}:
                    <p class="text-dark text-bold">
                        @if ($parent != '')
                        <a class=" text-decoration-none" href="{{route($relacion_show, [$relacion => $item->$relacion->id])}}">{{ $item->$relacion->name }}</a>
                        @else
                        <a class=" text-decoration-none" href="{{route($relacion_show, [$relacion => $item->$relacion->id])}}">{{ $item->$relacion->name }}</a>
                        @endif
                    </p>
                </li>
            @endif
          </ul>
    </div>
    <div class="btn-group-vertical">
    <div class="btn-group">
        
        @if ($parent != '')
            <a class="btn btn-outline-primary" href="{{route($ruta_edit, [$parent_singular=>$parent,$ruta_singular=>$item])}}">Modificar</a>
            
        @else
            <a class="btn btn-outline-primary" href="{{route($ruta_edit, [$ruta_singular=>$item])}}">Modificar</a>
            @if ($ruta == 'purchases')
            <a class="btn btn-outline-primary" href="{{$ruta}}/{{$item->id}}/details">Detalles</a>
            @else
            <a class="btn btn-outline-primary" href="{{$ruta}}/{{$item->id}}">Detalles</a>
            @endif
        @endif


        </div>
        @if ($parent != '')
            <button onclick="if(confirm('Desea eliminar el elemento [{{$item->id}}] de la tabla [{{__($ruta)}}]')){
            event.preventDefault();
            document.getElementById('delete-card').action='{{route($ruta_destroy, [$parent_singular=>$parent, $ruta_singular=>$item])}}';
            document.getElementById('delete-card').submit();
            }else{event.preventDefault();}" type="submit" class="btn btn-danger">Borrar Registro
            </button>
        @else
            <button onclick="if(confirm('Desea eliminar el elemento [{{$item->id}}] de la tabla [{{__($ruta)}}]')){
                event.preventDefault();
                document.getElementById('delete-card').action='{{route($ruta_destroy, [$ruta_singular=>$item])}}';
                document.getElementById('delete-card').submit();
                }else{event.preventDefault();}" type="submit" class="btn btn-danger">Borrar Registro
            </button>
        @endif
        
    </div>
    
</x-card-component>
@endforeach
<form id="delete-card" class="d-none" action="" method="POST">
    @csrf
    @method('DELETE')
</form>