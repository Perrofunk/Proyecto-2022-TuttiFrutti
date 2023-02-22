@props(['user'])
<div class="col d-flex justify-content-center m-0">
    <div class="card p-3">

        <div class="w-100">
            
           <h4 class="mb-0 mt-0">{{$user->name}} {{$user->surname}}</h4>
           <span>{{__(ucfirst($user->userType->name))}}</span>


           @if ($user->userType->name != "admin")
           <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">

            @if ($user->userType->name == "client")  
            <div class="d-flex flex-column">

                <span class="articles">Compras Realizadas</span>
                <span class="number1">{{count($user->sales)}}</span>
                
            </div>
            @endif
            <div class="d-flex flex-column">

                <span class="rating">Fecha de Creacion</span>
                <span class="number3">{{mb_strimwidth($user->created_at, 0, 10)}}</span>
                
            </div>
            @if ($user->userType->name == "client")
                
            <div class="d-flex flex-column">

                <span class="rating">Valor Total</span>
                
                @php
                    $total = 0;
                    foreach ($user->sales as $sale) {
                        $total += $sale->total;
                    }
                @endphp 
                
                <span class="number3">{{$total}}</span>
                
            </div>
            @endif

          
            
    

            
           </div>
           @endif


           <div class="button mt-2 d-flex flex-row align-items-center">

               <a href="{{route('users.show', ['user'=>$user])}}" class="btn btn-sm btn-primary w-100">Ver Perfil</a>
               <button onclick="if(confirm('Desea eliminar el usuario [{{$user->name}} {{$user->surname}} ID {{$user->id}}]')){
                event.preventDefault();
                document.getElementById('delete-user').action='{{route('users.destroy', ['user'=>$user])}}';
                document.getElementById('delete-user').submit();
                }else{event.preventDefault();}" type="submit" class="btn btn-sm btn-outline-danger w-100">Borrar</button>

               
           </div>


        </div>

            
        </div>
        
</div>
