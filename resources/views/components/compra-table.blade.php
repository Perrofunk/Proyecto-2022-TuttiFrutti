@props(['purchase'])


      <tr>
        <th scope="row">{{$purchase->id}}</th>
        <td>{{$purchase->date}}</td>
        <td>{{$purchase->total}}</td>
        <td><a href="{{route('suppliers.show', ['supplier' => $purchase->supplier->id])}}">{{$purchase->supplier->name}}</a></td>
        <td>Acciones</td>
      </tr>
      