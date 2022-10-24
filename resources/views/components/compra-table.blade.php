@props(['purchase'])


      <tr>
        <th scope="row">{{$purchase->id}}</th>
        <td>{{$purchase->date}}</td>
        <td>{{$purchase->total}}</td>
        <td><a href="#">{{$purchase->supplier->name}}</a></td>
        <td>Acciones</td>
      </tr>
      