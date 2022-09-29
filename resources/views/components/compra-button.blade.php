@props(['compra'])

<x-card-component class="border border-dark">

    <h2 class="text-center bg-dark card-header">ID {{ $compra->id }}</h2>
    <div class="card-body">
        
        <ul class="list-group list-group-flush">
            <li class="list-group-item text-center text-secondary">Total: 
                <p class="text-dark text-bold">{{ $compra->total }}</p>
            </li>
            <li class="list-group-item text-center text-secondary">Fecha y hora: 
                <p class="text-dark text-bold">{{ $compra->fecha }}</p>
            </li>
            <li class="list-group-item text-center text-secondary">Proveedor: 
                <p class="text-dark text-bold"><a class=" text-decoration-none" href="#">{{ $compra->supplier->where('id', $compra->supplier_id)->first()->nombre }}</a></p>
            </li>
          </ul>
    </div>
    <div class="btn-group-vertical">
    <div class="btn-group">
        
            <a class="btn btn-outline-primary" href="{{$compra->id}}">Detalles</a>
        
            <a class="btn btn-outline-primary" href="#">Modificar</a>

        </div>
            <a class="btn btn-danger" href="#">Borrar Registro</a>
    </div>

</x-card-component>
