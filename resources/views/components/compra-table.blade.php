@props(['purchase'])


      <tr>
        <th scope="row">{{$purchase->id}}</th>
        <td>{{$purchase->fecha}}</td>
        <td>{{$purchase->total}}</td>
        <td><a href="#">{{$purchase->supplier->nombre}}</a></td>
        <td>Acciones</td>
      </tr>
      