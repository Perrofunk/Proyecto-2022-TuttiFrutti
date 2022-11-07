@props(['type', 'variable', 'relacion'=>"", 'relacion_modelos'=>"", 'relacion_child_modelos'=>""])
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

//Relationships (relacion, relacion_id, modelos, plural)
$relacion_id = null;
$products = App\Models\Product::all();

if ($relacion_modelos != "") {
    //tabla del modelo relacionado
    $relacion_tabla = $relacion_modelos->first()->getTable();

    if ($relacion_tabla === "categories") {
        $relacion_plural = $relacion_tabla;
        $relacion = rtrim($relacion_plural, 'ies') ."y";
    }else {
        $relacion_plural = $relacion_tabla;
        $relacion = rtrim($relacion_plural, 's');
    }
    $relacion_id = $relacion . "_id";
}
if ($relacion_child_modelos != "") {
    $relacion_child_tabla = $relacion_child_modelos->first()->getTable();

    if ($relacion_child_tabla === "categories") {
        $relacion_child_plural = $relacion_child_tabla;
        $relacion_child = rtrim($relacion_child_plural, 'ies') ."y";
    }else {
        $relacion_child_plural = $relacion_child_tabla;
        $relacion_child = rtrim($relacion_child_plural, 's');
    }
    $relacion_child_id = $relacion_child . "_id";
}
$requiredFields = ['name', 'price', 'description', 'quantity', 'email', 'surname', 'password', $relacion_id];


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
@if ($type === "edit")
{!! Form::model($variable,['route' => [$route_update, $variable], 'autocomplete' => 'off', 'files' => true, 'method' => 'put']) !!}
    <div class="grid grid-cols-2 gap-6 ml-2 mr-5">
    @foreach ($columns as $column)
    @if ($column === "total")
        @continue
    @endif
    @if (preg_match('/(_id)/', $column) == true)
    <div class="mb-6">
        <label for="{{$column}}" class="block mb-2 font-medium text-gray-900">{{__($column)}}</label>
        <select name="{{$column}}" id="{{$column}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @foreach ($relacion_modelos as $relacion_item)  
                @if ($loop->first)
                <option value="">Seleccionar...</option>
                @endif
                <option value="{{$relacion_item->id}}">{{$relacion_item->name}}</option>
            @endforeach
    </select>
    </div>
    @else
    <div class="mb-6">
        
        <label for="{{$column}}" class="block mb-2 font-medium text-gray-900">{{__($column)}}</label>
        <input name="{{$column}}" type="{{inputType($column)}}" id="{{$column}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
    @isset($relacion_child_tabla)
    @if (preg_match('/(_details)/', $relacion_child_tabla))
            @php
                $relacion_child_columns = array_keys($relacion_child_modelos->first()->getAttributes());
                $relacion_child_columns = array_diff($relacion_child_columns, ['id', 'created_at', 'updated_at']);
                if (in_array('purchase_id', $relacion_child_columns)) {
                    $relacion_child_columns = array_diff($relacion_child_columns, ['purchase_id']);
                }
                
            @endphp
            
            @foreach ($relacion_child_columns as $relacion_child_column)
            @if ($relacion_child_column === "price")
        @continue
    @endif
            @if (preg_match('/(_id)/', $relacion_child_column) == true)
            <div class="mb-6">
                <label for="{{$relacion_child_column}}" class="block mb-2 font-medium text-gray-900">{{__($relacion_child_column)}}</label>
                <select name="{{$relacion_child_column}}" id="{{$relacion_child_column}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    
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
                    <label for="{{$relacion_child_column}}" class="block mb-2 font-medium text-gray-900">{{__($relacion_child_column)}}</label>
                    <input name="{{$relacion_child_column}}" type="{{inputType($relacion_child_column)}}" id="{{$relacion_child_column}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                @endif
            @endforeach
        @endif
        @endisset
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center ">Register new account</button>
   {!! Form::close() !!}
  <script>
    
  </script>
@endif




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
            @foreach ($relacion_modelos as $relacion_item)  
                @if ($loop->first)
                <option value="">Seleccionar...</option>
                @endif
                <option value="{{$relacion_item->id}}">{{$relacion_item->name}}</option>
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
    @isset($relacion_child_tabla)
    @if (preg_match('/(_details)/', $relacion_child_tabla))
            @php
                $relacion_child_columns = array_keys($relacion_child_modelos->first()->getAttributes());
                $relacion_child_columns = array_diff($relacion_child_columns, ['id', 'created_at', 'updated_at']);
                if (in_array('purchase_id', $relacion_child_columns)) {
                    $relacion_child_columns = array_diff($relacion_child_columns, ['purchase_id']);
                }
                
            @endphp
            
            @foreach ($relacion_child_columns as $relacion_child_column)
            @if ($relacion_child_column === "price")
            @continue
            @endif  
            @if (preg_match('/(_id)/', $relacion_child_column) == true)
            <div class="mb-6">
                <label for="{{$relacion_child_column}}" class="block mb-2 font-medium text-gray-900">{{__($relacion_child_column)}}</label>
                <select name="{{$relacion_child_column}}" id="{{$relacion_child_column}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" {{required($relacion_child_column, $requiredFields)}}>
                    
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
                    <label for="{{$relacion_child_column}}" class="block mb-2 font-medium text-gray-900">{{__($relacion_child_column)}}</label>
                    <input name="{{$relacion_child_column}}" type="{{inputType($relacion_child_column)}}" id="{{$relacion_child_column}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" {{required($relacion_child_column, $requiredFields)}}>
                </div>
                @endif
            @endforeach
        @endif
        @endisset
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center ">Register new account</button>
  </form>
  <script>
    
  </script>
@endif