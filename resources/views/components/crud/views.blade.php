@props(['manualPaginator'=>'', 'variable', 'parent'=>'', 'relacion'=>"", 'ruta'])

@php
   
@endphp
<hr class=" mt-3">
{{ $variable->links() }}
<div class="d-flex flex-column-reverse">
    <div class="btn-group" role="group" aria-label="Button group">
        <button class="btn rounded-0 btn-primary" x-on:click="card = true, table = false">
            Vista De Carta
        </button>
        <button class="btn rounded-0 btn-primary" x-on:click="card = false, table = true">
            Vista De Tabla
        </button>
    </div>
    </div>

    <div x-transition x-show.important="card" class="row row-cols-2 row-cols-md-4">
        
        @if ($variable->first()->getTable() === "products")
        <x-products-component :products="$variable" :variable="true" />
        @else
        <x-crud.card :variable="$variable" :parent="$parent" :relacion="$relacion" :ruta="$ruta" />
            
        @endif
        
    </div>
    <div x-transition x-show.important="table">
        <table class="table table-striped table-bordered text-center">
            <x-crud.table :variable="$variable" :parent="$parent" :relacion="$relacion" :ruta="$ruta" />
        </table>
    </div>
</div>

{{-- Links de Paginacion --}}

    {{ $variable->links() }}