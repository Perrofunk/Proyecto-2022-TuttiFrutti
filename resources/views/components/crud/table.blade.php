@props(['variable', 'relacion'=>"", 'parent'=>'' , 'ruta'])

@php
use Illuminate\Database\Eloquent\Model;
if ($parent != '') {
    $parent_table = $parent->getTable();
    $parent_singular = rtrim($parent_table, 's');
}

  $ruta_edit = $ruta . ".edit";
  $ruta_destroy = $ruta . ".destroy";
  $ruta_singular = rtrim($ruta, "s");
  $relacion_show = $relacion . "s.show";
  $relacion_id = $relacion . "_id";
  if ($relacion === "category") {
    $relacion_show = rtrim($relacion, "y") . "ies.show";
  }
  $columns = array_keys($variable->first()->getAttributes());
  $columns = array_diff($columns, ['created_at', 'updated_at']);
  
@endphp
<thead class="table-dark">
  <tr>
    @foreach ($columns as $column)
      <th scope="col">{{ucfirst(__($column))}}</th>
    @endforeach
      <th scope="col" class="bg-primary border-primary border-bottom-0">Acciones</th>
  </tr>
</thead>
<tbody>
  @php
    $columns = array_diff($columns, ['id', $relacion_id]);
    @endphp
  @foreach ($variable as $item)
    <tr>
      <th scope="row">{{ $item->id }}</th>
      @foreach ($columns as $column)
        <td>{{$item[$column]}}</td>
      @endforeach

      @if ($relacion != "")  
        <td><a href="{{route($relacion_show, [$relacion => $item->$relacion->id])}}">{{$item->$relacion->name}}</a></td>
      @endif

      <td class="d-flex justify-content-end"><div class="btn-group">
        @if ($parent != '')
          <a class="text-decoration-none btn rounded-0  btn-outline-warning" href="{{route($ruta_edit, [$parent_singular=>$parent, $ruta_singular=>$item])}}">Modificar</a>
          <button onclick="if(confirm('Esta a punto de eliminar el elemento [{{$item->id}}] de la tabla [{{__($ruta)}}]')){
            event.preventDefault();
            document.getElementById('delete-table').action='{{route($ruta_destroy, [$parent_singular=>$parent, $ruta_singular=>$item])}}';
            document.getElementById('delete-table').submit();
            }else{event.preventDefault();}" type="submit" class="btn rounded-0 btn-danger">Borrar</button>
        @else  
          @if ($ruta == 'purchases')
          <a class="btn btn-outline-primary" href="{{$ruta}}/{{$item->id}}/details">Detalles</a>
          @else
          <a class="btn btn-outline-primary" href="{{$ruta}}/{{$item->id}}">Detalles</a>
          @endif
          <a class="text-decoration-none btn rounded-0  btn-outline-warning" href="{{route($ruta_edit, [$ruta_singular=>$item])}}">Modificar</a>
          <button onclick="if(confirm('Esta a punto de eliminar el elemento [{{$item->id}}] de la tabla [{{__($ruta)}}]')){
            event.preventDefault();
            document.getElementById('delete-table').action='{{route($ruta_destroy, [$ruta_singular=>$item])}}';
            document.getElementById('delete-table').submit();
            }else{event.preventDefault();}" type="submit" class="btn rounded-0 btn-danger">Borrar</button>
        @endif
      </div></td>
    </tr>

    @endforeach
    <form id="delete-table" class="d-none" action="" method="POST">
      @csrf
      @method('DELETE')
    </form>
</tbody>
      