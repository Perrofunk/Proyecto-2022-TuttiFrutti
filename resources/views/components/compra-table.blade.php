@props(['purchase'])


      <tr>
        <th scope="row">{{$purchase->id}}</th>
        <td>{{$purchase->date}}</td>
        <td>{{$purchase->total}}</td>
        <td><a href="{{route('suppliers.show', ['supplier' => $purchase->supplier->id])}}">{{$purchase->supplier->name}}</a></td>
        <td class="d-flex justify-content-end"><div class="btn-group">
          <a class="text-decoration-none btn rounded-0  btn-outline-warning" href="{{route('purchases.edit', ['purchase'=>$purchase])}}">Modificar</a>
          <a class="btn rounded-0  btn-danger text-decoration-none" href="{{route('purchases.destroy', ['purchase'=>$purchase])}}">Borrar</a>
      </div></td>
      </tr>
      