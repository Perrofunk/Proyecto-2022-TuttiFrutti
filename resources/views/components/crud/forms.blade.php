@props(['type', 'variable', 'relationship'=>"", 'relationship_parent_models'=>"", 'relationship_child_models'=>""])
@php
use Illuminate\Support\Facades\DB;

//Columns
$columns = array_keys($variable->first()->getAttributes());
$columns = array_diff($columns, ['id', 'created_at', 'updated_at']);

//Route (store, destroy, edit, create, show, index)
$variable_table = $variable->first()->getTable();
$variable_singular = rtrim($variable_table, "s");
$route_store =  $variable_table . ".store";
$route_update = $variable_table . ".update";
$route_index = $variable_table . ".index";

//Relationships (relationship, relationship_parent_id, models, plural)
$relationship_parent_id = null;
$products = App\Models\Product::all();

//Si existe una relacion donde $variable es el hijo:
if ($relationship_parent_models != "") {
    //tabla del modelo padre
    $relationship_parent_table = $relationship_parent_models->first()->getTable();

    if ($relationship_parent_table === "categories") {
        $relationship_parent_plural = $relationship_parent_table;
        $relationship_parent_singular = rtrim($relationship_parent_plural, 'ies') ."y";
    }else {
        $relationship_parent_plural = $relationship_parent_table;
        $relationship_parent_singular = rtrim($relationship_parent_plural, 's');
    }
    $relationship_parent_id = $relationship_parent_singular . "_id";
}
if ($relationship_child_models != "") {
    $relationship_child_table = $relationship_child_models->first()->getTable();

    if ($relationship_child_table === "categories") {
        $relationship_child_plural = $relationship_child_table;
        $relationship_child = rtrim($relationship_child_plural, 'ies') ."y";
    }else {
        $relationship_child_plural = $relationship_child_table;
        $relationship_child = rtrim($relationship_child_plural, 's');
    }
    $relationship_child_id = $relationship_child . "_id";
}
$requiredFields = ['name', 'price', 'description', 'quantity', 'email', 'surname', 'password', $relationship_parent_id];


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
{!! Form::model($variable,['id'=>'form', 'route' => [$route_update, $variable], 'autocomplete' => 'off', 'files' => true, 'method' => 'put']) !!}
    <div class="grid grid-cols-2 gap-6 ml-2 mr-5">
    @foreach ($columns as $column)
    @if ($column === "total")
        @continue
    @endif
    @if (preg_match('/(_id)/', $column) == true)
        <div class="mb-6">
            <label for="{{$column}}" class="block mb-2 font-medium text-gray-900">{{__($column)}}</label>
            <select name="{{$column}}" id="{{$column}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @foreach ($relationship_parent_models as $relationship_item)  
                    @if ($loop->first)
                    <option value="{{$relationship_item->id}}">{{$relationship_item->name}}</option>
                    @endif
                    <option value="{{$relationship_item->id}}">{{$relationship_item->name}}</option>
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

    @isset($relationship_child_table)
    @if (preg_match('/(_details)/', $relationship_child_table))
            @php
                $relationship_child_columns = array_keys($relationship_child_models->first()->getAttributes());
                $relationship_child_columns = array_diff($relationship_child_columns, ['id', 'created_at', 'updated_at']);
                if (in_array('purchase_id', $relationship_child_columns)) {
                    $relationship_child_columns = array_diff($relationship_child_columns, ['purchase_id']);
                }
                
            @endphp
            
            @foreach ($relationship_child_columns as $relationship_child_column)
            
    
            @if (preg_match('/(_id)/', $relationship_child_column) == true)
            <div class="mb-6 col-span-2 text-center">
                <input type="hidden" id="detail" name="detail">
                <button class="text-center w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded" type="submit" onclick="
                event.preventDefault();
                document.getElementById('detail').value=true;
                document.getElementById('form').submit();
                ">Modificar Detalles</button>
            </div>
            
                @endif
            @endforeach
        @endif
        @endisset
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center ">Aceptar</button>
    <a href="{{route($route_index)}}"><button type="button" class="text-white bg-zinc-700 hover:bg-zinc-800 focus:ring-4 focus:outline-none focus:ring-zinc-300 font-medium rounded-lg px-5 py-2.5 text-center ">Cancelar</button></a>
   {!! Form::close() !!}
  <script>
    
  </script>
@endif




{{-- CREATE --}}

@if ($type === "create")
<form method="POST" enctype="multipart/form-data" action="{{ route($route_store) }}">
    @csrf
    <div class="grid grid-cols-2 gap-6 ml-2 mr-5">
    @foreach ($columns as $column)
    
    @if ($column === "total")
        @continue
    @endif
    @if (preg_match('/(_id)/', $column) == true)
    <div class="mb-6">
        <label for="{{$column}}" class="block mb-2 font-medium text-gray-900">{{__($column)}}</label>
        <select name="{{$column}}" id="{{$column}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" {{required($column, $requiredFields)}}>
            @foreach ($relationship_parent_models as $relationship_item)  
                @if ($loop->first)
                <option value="">Seleccionar...</option>
                @endif
                <option value="{{$relationship_item->id}}">{{$relationship_item->name}}</option>
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
        @if ($variable->first()->getTable() === "products")
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
    @isset($relationship_child_table)
    @if (preg_match('/(_details)/', $relationship_child_table))
            @php
                $relationship_child_columns = array_keys($relationship_child_models->first()->getAttributes());
                $relationship_child_columns = array_diff($relationship_child_columns, ['id', 'created_at', 'updated_at']);
                if (in_array('purchase_id', $relationship_child_columns)) {
                    $relationship_child_columns = array_diff($relationship_child_columns, ['purchase_id']);
                }
                
            @endphp
            
            @foreach ($relationship_child_columns as $relationship_child_column)   
            @if (preg_match('/(_id)/', $relationship_child_column) == true)
            <div class="mb-6">
                <label for="{{$relationship_child_column}}" class="block mb-2 font-medium text-gray-900">{{__($relationship_child_column)}}</label>
                <select name="{{$relationship_child_column}}" id="{{$relationship_child_column}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" {{required($relationship_child_column, $requiredFields)}}>
                    
                    @foreach ($products as $product)
                    
                        @if ($loop->first)
                        <option value="">Seleccionar...</option>
                        @endif
                        <option value="{{$product->id}}">{{$product->name}}</option>
                        
                    @endforeach
            </select>
            </div>
            @else
                <div class="mb-6">
                    <label for="{{$relationship_child_column}}" class="block mb-2 font-medium text-gray-900">{{__($relationship_child_column)}}</label>
                    <input name="{{$relationship_child_column}}" type="{{inputType($relationship_child_column)}}" id="{{$relationship_child_column}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" {{required($relationship_child_column, $requiredFields)}}>
                </div>
                @endif
            @endforeach
        @endif
        @endisset
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center ">Aceptar</button>
    <a href="{{route($route_index)}}"><button type="button" class="text-white bg-zinc-700 hover:bg-zinc-800 focus:ring-4 focus:outline-none focus:ring-zinc-300 font-medium rounded-lg px-5 py-2.5 text-center ">Cancelar</button></a>
  </form>
  <script>
    
  </script>
@endif