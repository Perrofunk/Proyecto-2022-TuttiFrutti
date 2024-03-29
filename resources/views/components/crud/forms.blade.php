@props(['type', 'variable', 'relationship'=>"", 'second_parent'=>'', 'first_parent_models'=>"", 'first_child_models'=>""])
@php
use Illuminate\Support\Facades\DB;

//Columns
$columns = array_keys($variable->first()->getAttributes());
$skippable = ['id', 'created_at', 'updated_at', 'total', 'purchase_id'];
function checkIfSkippable($column, $skippable){
    if (in_array($column, $skippable)) {
        return true;
    } else { return false; }
}
//Route (store, destroy, edit, create, show, index)
if (preg_match('/(purchase_)/', $variable)) {
    $variable_table = 'details';
}
else {
    $variable_table = $variable->first()->getTable();
    $variable_singular = rtrim($variable_table, "s");
}
if (preg_match('/(purchase_)/', $variable_table)) {
    $variable_table = 'details';
}
$route_store =  $variable_table . ".store";
$route_update = $variable_table . ".update";
$route_index = $variable_table . ".index";

//Relationships (relationship, first_parent_id, models, plural)
$products = App\Models\Product::all();

//Si existe una relacion donde $variable es el hijo:
$first_parent_id = null;
if ($first_parent_models != "") {
    //tabla del modelo padre
    $first_parent_table = $first_parent_models->first()->getTable();

    if ($first_parent_table === "categories") {
        
        $first_parent_singular = rtrim($first_parent_table, 'ies') ."y";
    }else {
        $first_parent_singular = rtrim($first_parent_table, 's');
    }
    $first_parent_id = $first_parent_singular . "_id";
}
if ($first_child_models != "") {
    $first_child_table = $first_child_models->first()->getTable();

    if ($first_child_table === "categories") {
        $first_child = rtrim($first_child_table, 'ies') ."y";
    }else {
        $first_child = rtrim($first_child_table, 's');
    }
    $first_child_id = $first_child . "_id";
}
$requiredFields = ['name', 'price', 'description', 'quantity', 'email', 'surname', 'password', $first_parent_id];
function required($column, $array){
    if (in_array($column, $array)) {
        return 'required=true';
    } else {
        //
    }
}
function inputType($column){
    switch ($column) {
        case 'price':
            return 'number';
        case 'date':
            return 'datetime';
        case 'password':
            return 'password';
        case 'email':
            return 'email';
        case 'quantity':
            return 'number';
        default:
            'text';
    };
}

  
@endphp

{{-- EDIT --}}

@if ($type === "edit")

@if ($variable_table == "details")
{!! Form::model($variable,['id'=>'form1', 'route' => [$route_update, ['purchase'=>$second_parent, 'detail'=>$variable]], 'autocomplete' => 'off', 'files' => true, 'method' => 'put']) !!}
@else
{!! Form::model($variable,['id'=>'form1', 'route' => [$route_update, $variable], 'autocomplete' => 'off', 'files' => true, 'method' => 'put']) !!}
@endif

    <div class="grid grid-cols-2 gap-6 ml-2 mr-5">
    @foreach ($columns as $column)
    @if (checkIfSkippable($column, $skippable))
        @continue
    @endif
    @if (preg_match('/(_id)/', $column) == true)
        <div class="mb-6">
            <label for="{{$column}}" class="block mb-2 font-medium text-gray-900">{{__($column)}}</label>
            <select name="{{$column}}" id="{{$column}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @foreach ($first_parent_models as $parent_item)  
                    @if ($loop->first)
                    <option value="{{$parent_item->id}}">{{$parent_item->name}}</option>
                    @endif
                    <option value="{{$parent_item->id}}">{{$parent_item->name}}</option>
                @endforeach
        </select>
        </div>
    @else
    <div class="mb-6">
        
        <label for="{{$column}}" class="block mb-2 font-medium text-gray-900">{{__($column)}}</label>
        <input value="{{$variable->$column}}" name="{{$column}}" type="{{inputType($column)}}" id="{{$column}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
    </div>
    @endif
    @if ($loop->last)
        @if ($variable_table === "products")
            <div class="mb-6">
                
                
                {!! Form::file('image', ['accept' => 'image/*', 'class' => 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']) !!}
                @error('image')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        @endif
    @endif
    @endforeach

    @isset($first_child_table)
    @if (preg_match('/(_details)/', $first_child_table))
            @php
                $first_child_columns = array_keys($first_child_models->first()->getAttributes());
                $first_child_columns = array_diff($first_child_columns, ['id', 'created_at', 'updated_at']);
                if (in_array('purchase_id', $first_child_columns)) {
                    $first_child_columns = array_diff($first_child_columns, ['purchase_id']);
                }
                
            @endphp
            
            @foreach ($first_child_columns as $first_child_column)
            
    
            @if (preg_match('/(_id)/', $first_child_column) == true)
            <div class="mb-6 col-span-2 text-center">
                <input type="hidden" id="detail" name="detail">
                <button class="text-center w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded" type="submit" onclick="
                event.preventDefault();
                document.getElementById('detail').value=true;
                document.getElementById('form1').submit();
                ">Guardar Cambios y Modificar Detalles</button>
            </div>
            
                @endif
            @endforeach
        @endif
        @endisset
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center ">Aceptar</button>
    @if ($variable_table == "details")
    <a href="{{route($route_index, ['purchase'=>$second_parent])}}"><button type="button" class="text-white bg-zinc-700 hover:bg-zinc-800 focus:ring-4 focus:outline-none focus:ring-zinc-300 font-medium rounded-lg px-5 py-2.5 text-center ">Cancelar</button></a>
    @else
    <a href="{{route($route_index)}}"><button type="button" class="text-white bg-zinc-700 hover:bg-zinc-800 focus:ring-4 focus:outline-none focus:ring-zinc-300 font-medium rounded-lg px-5 py-2.5 text-center ">Cancelar</button></a>
    @endif
   {!! Form::close() !!}
  <script>
    
  </script>
@endif




{{-- CREATE --}}

@if ($type === "create")

<form id="form2" method="POST" enctype="multipart/form-data" action="@if ($route_store != 'details.store')
{{route($route_store)}}
@else
    {{route($route_store, ['purchase'=>$second_parent])}}
@endif">
    @csrf
    <div class="grid grid-cols-2 gap-6 ml-2 mr-5">
    @foreach ($columns as $column)
    
    @if (checkIfSkippable($column, $skippable))
        @continue
    @endif
    @if (preg_match('/(_id)/', $column) == true)
    @if ($column == "purchase_id")
        @continue
    @endif
    <div class="mb-6">
        <label for="{{$column}}" class="block mb-2 font-medium text-gray-900">{{__($column)}}</label>
        <select name="{{$column}}" id="{{$column}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" {{required($column, $requiredFields)}}>
            @foreach ($first_parent_models as $parent_item)  
                @if ($loop->first)
                <option value="">Seleccionar...</option>
                @endif
                <option value="{{$parent_item->id}}">{{$parent_item->name}}</option>
            @endforeach
    </select>
    </div>
    @else
    <div class="mb-6">
        <label for="{{$column}}" class="block mb-2 font-medium text-gray-900">{{__($column)}}</label>
        <input name="{{$column}}" type="{{inputType($column)}}" id="{{$column}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" {{required($column, $requiredFields)}}>
    </div>
    @endif
    @if ($loop->last)
        @if ($variable_table === "products")
            <div class="mb-6">
                
                
                {!! Form::file('image', ['accept' => 'image/*', 'class' => 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5']) !!}
                @error('image')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        @endif
    @endif
    @endforeach
    @php
        
      
    @endphp
    @isset($first_child_table)
    @if (preg_match('/(_details)/', $first_child_table))
            @php
            $first_child_columns = array_keys($first_child_models->first()->getAttributes());
            $first_child_columns = array_diff($first_child_columns, ['id', 'created_at', 'updated_at']);
            if (in_array('purchase_id', $first_child_columns)) {
                $first_child_columns = array_diff($first_child_columns, ['purchase_id']);
            }    
            @endphp

        @foreach ($first_child_columns as $first_child_column)

        @if (preg_match('/(_id)/', $first_child_column) == true)
            <div class="mb-6 text-center">
                <input type="hidden" id="detail" name="detail">
                <button class="text-center bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded" type="submit" onclick="
                event.preventDefault();
                document.getElementById('detail').value=true;
                document.getElementById('form2').submit();
                ">Guardar Cambios y Modificar Detalles</button>
            </div>
            @if ($variable_table == 'purchases')
                <a href="{{route($route_index)}}"><button type="button" class="text-white bg-zinc-700 hover:bg-zinc-800 focus:ring-4 focus:outline-none focus:ring-zinc-300 font-medium rounded-lg px-5 py-2.5 text-center ">Cancelar</button></a>
            @endif
        @endif

        @endforeach
    @endif
    @endisset
    </div>
    @if ($variable_table == 'purchases')
        
    @else
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center ">Aceptar</button>
        @if ($variable_table == "details")
       
        <a href="{{route('details.index', [array_keys(Route::current()->parameters())[0] => Route::current()->parameters()['purchase']])}}"><button type="button" class="text-white bg-zinc-700 hover:bg-zinc-800 focus:ring-4 focus:outline-none focus:ring-zinc-300 font-medium rounded-lg px-5 py-2.5 text-center ">Cancelar</button></a>
        @else
        <a href="{{route($route_index)}}"><button type="button" class="text-white bg-zinc-700 hover:bg-zinc-800 focus:ring-4 focus:outline-none focus:ring-zinc-300 font-medium rounded-lg px-5 py-2.5 text-center ">Cancelar</button></a>
        @endif
    @endif
  </form>
  <script>
    
  </script>
@endif