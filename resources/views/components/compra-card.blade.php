@props(['purchase'])

<x-card-component class="border border-dark">

    <h2 class="text-center bg-dark card-header">ID {{ $purchase->id }}</h2>
    <div class="card-body">
        
        <ul class="list-group list-group-flush">
            <li class="list-group-item text-center text-secondary">Total: 
                <p class="text-dark text-bold">{{ $purchase->total }}</p>
            </li>
            <li class="list-group-item text-center text-secondary">Fecha y hora: 
                <p class="text-dark text-bold">{{ $purchase->date }}</p>
            </li>
            <li class="list-group-item text-center text-secondary">Proveedor: 
                <p class="text-dark text-bold"><a class=" text-decoration-none" href="#">{{ $purchase->supplier->name }}</a></p>
            </li>
          </ul>
    </div>
    <div class="btn-group-vertical">
    <div class="btn-group">
        
            <a class="btn btn-outline-primary" href="purchases/{{$purchase->id}}">Detalles</a>
        
            <a class="btn btn-outline-primary" href="#">Modificar</a>

        </div>
            <a class="btn btn-danger" href="#">Borrar Registro</a>
    </div>

</x-card-component>
