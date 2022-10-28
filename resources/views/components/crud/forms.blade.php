@props(['type', 'variable', 'relacion'=>"", 'relacion_modelos'=>""])
@php
use Illuminate\Support\Facades\DB;

$columns = array_keys($variable->first()->getAttributes());
$columns = array_diff($columns, ['id', 'created_at', 'updated_at']);
$ruta_store = $variable->first()->getTable() . ".store";
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
    
@endif
@if ($type === "create")
<form method="POST" action="{{ route($ruta_store) }}">
    @csrf
    <div class="grid grid-cols-2 gap-6 ml-2 mr-5">
    @foreach ($columns as $column)
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
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center ">Register new account</button>
  </form>
@endif