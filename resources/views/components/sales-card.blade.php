@props(['sale'])
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-horizontal">
                    
                    <div class="card-body">
                        <h4 class="card-title">{{$sale->date}}</h4>
                        <h3>Total: {{$sale->total}}</h3>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route("sales.show", ["sale"=>$sale->id])}}" class="btn btn-sm"><small class="text-muted">Ver Detalles</small></a>
                </div>
            </div>
        </div>
    </div>
</div>