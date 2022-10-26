@props(['variable', 'relacion'=>"", 'ruta'])

@php
use Illuminate\Database\Eloquent\Model;
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
      <th scope="col">{{__($column)}}</th>
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
        <a class="text-decoration-none btn rounded-0  btn-outline-warning" href="{{route($ruta_edit, [$ruta_singular=>$item])}}">Modificar</a>
        <a class="btn rounded-0  btn-danger text-decoration-none" href="{{route($ruta_destroy, [$ruta_singular=>$item])}}">Borrar</a>
      </div></td>
    </tr>
  @endforeach
</tbody>
      