@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    {{Breadcrumbs::render()}}
    <hr class="mt-3">
@stop
@section('content')

<div class="card m-0 p-3">
    <div class="card-header">
        Editar Venta
    </div>

    <div class="card-body">
        <form action="{{ route("sales.update", [$sale->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                        @php
                        function selected($client, $sale){
                            if ($client->user->id == $sale->user_id) {
                                return "selected";
                            }
                        }
                            
                        @endphp
            <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                <label for="user_id">Usuario</label>
                    <select id="user_id" name="user_id" class="form-control">
                        <option value="">-- seleccionar --</option>
                        @foreach (App\Models\Client::all() as $client)
                                    <option {{$client->user_id == $sale->user_id ? 'selected' : ''}} value="{{ $client->user_id }}">
                                        {{ $client->user->name }} {{$client->user->surname}}
                                    </option>
                            @endforeach
                    </select>
                    
                @if($errors->has('user_id'))
                    <em >
                        {{ $errors->first('user_id') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('payment_type_id') ? 'has-error' : '' }}">
                <label for="payment_type_id">Tipo de Pago</label>
                    <select id="payment_type_id" name="payment_type_id" class="form-control">
                        <option value="">-- seleccionar --</option>
                        @foreach (App\Models\PaymentType::all() as $paymentType)
                                    <option {{$paymentType->id == $sale->payment_type_id ? 'selected' : ''}} value="{{ $paymentType->id }}">
                                        {{ ucfirst(__($paymentType->name)) }}
                                    </option>
                            @endforeach
                    </select>
                    
                @if($errors->has('payment_type_id'))
                    <em >
                        {{ $errors->first('payment_type_id') }}
                    </em>
                @endif
            </div>
           
            <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                <label for="date">Fecha</label>
                <small>{{$sale->date}}</small>
                <input type="date" id="date" name="date" class="form-control" value="{{ $sale->date }}">
                @if($errors->has('date'))
                    <em>
                        {{ __($errors->first('date')) }}
                    </em>
                @endif
                
            </div>


            <div class="card">
                <div class="card-header">
                    Productos
                </div>
                @php
                // foreach (($sale->details->count() ? $sale->details : ['']) as $sale_product){
                //     foreach ($products as $product){
                //         if ($sale_product->product_id == $product->id) {
                            
                //             dd($sale_product);
                //         }
                //     }
                //     dd(($loop->parent->index->id) == $product->id);
                // }
                
                @endphp
                <div class="card-body">
                    <table class="table" id="products_table">
                        <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach (($sale->details->count() ? $sale->details : ['']) as $sale_product)
                            <tr id="product{{ $loop->index }}">
                                <td>
                                    <select name="products[]" class="form-control">
                                        <option value="">-- elegir producto --</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                @if ($sale_product->product_id == $product->id) selected @endif
                                            >{{ $product->name }} (${{ number_format($product->price, 2) }})</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="quantities[]" class="form-control"
                                           value="{{ $sale_product->quantity }}" min="1" />
                                </td>
                            </tr>
                        @endforeach
                        <tr id="product{{ count(old('products', $sale->details->count() ? $sale->details : [''])) }}"></tr>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-12">
                            <button id="add_row" class="btn btn-default pull-left">+ Añadir Fila</button>
                            <button id='delete_row' class="pull-right btn btn-danger">- Borrar Fila</button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <input class="btn btn-outline-primary" type="submit" value="{{ ucfirst(__('save')) }}">
        <a href="{{route('sales.index')}}" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>


    </div>
</div>
@endsection

@section('js')
    <script>
      $(document).ready(function(){
        let row_number = {{ count($sale->details->count() ? $sale->details : ['']) }};
        $("#add_row").click(function(e){
          e.preventDefault();
          let new_row_number = row_number - 1;
          $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
          $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
          row_number++;
        });

        $("#delete_row").click(function(e){
          e.preventDefault();
          if(row_number > 1){
            $("#product" + (row_number)).remove();
            row_number--;
          }
        });
      });
    </script>
@endsection