@extends('layouts.main')
@section('title')
    <title>Mis compras</title>
@endsection 
@section('section')
   <!-- html aqui-->
   <section>
<table class="table table-dark">
  <thead>
    <tr>
    	<th scope="col">#</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio unitario</th>
      <th scope="col">Accion</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Cafe clasico</td>
      <td>1</td>
      <td>$85</td>
      <td>Eliminar</td>
    </tr>
  </tbody>
</table>
<conteiner>
	<tr>
 <td>Subtotal=</td>
 <hr/>
 <td>IVA=</td>
 <hr/>
 <td>Total=</td>
 <hr/>
 <input type="submit" value="Pagar" class="btn-block btn btn-outline-primary"                  
</tr>
	</conteiner>>
</section>>
@endsection