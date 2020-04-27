@extends('layouts.main')
@section('title')
    <title>Movimientos - {{$user->name}}</title>
@endsection
@section('section')
<div class="container">
    <div class="row my-4">
        <div class="col-12">
            <p class="text-center h5">Datos del usuario</p>
        </div>
    </div>
    <div class="row my-4 d-flex justify-content-center">
        <div class="col-md-6 col-12 text-center">
            <p><span class="font-weight-bold">Nombre</span>: {{$user->name}} {{$user->last_name}}</p>
            <p><span class="font-weight-bold">Dirección</span>: {{$user->address}}, CP: {{$user->cp}}</p>
            <p><span class="font-weight-bold">Correo electrónico</span>: {{$user->email}}, <span class="font-weight-bold">Teléfono</span>: {{$user->phone}}</p>
        </div>
    </div>
    <section class="row my-4">
        <section class="col-12 mb-3">
            <p class="text-center h4">Compras entregadas y por entregar</p>
        </section>
        <section class="col-12">
            <table class="table table-sm table-striped table-hover table-borderless">
                <thead class="text-center">
                    <tr>                    
                        <th>No.pedido</th>
                        <th class="hidden">Subtotal</th>
                        <th class="hidden">IVA</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th class="hidden">Fecha</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                   @if (!is_null($orders))
                       @foreach ($orders as $order)
                       <tr>
                        <td class="align-middle">{{$order->id}}</td>
                        <td class="hidden align-middle">{{$order->subTotal}}</td>
                        <td class="hidden align-middle">{{$order->iva}}</td>
                        <td class=" align-middle">{{$order->total}}</td>
                        <td class="align-middle">
                            @if ($order->status ==='PENDING')
                              <span class="text-danger">Por entregar</span>
                            @else
                              <span class="text-success">Entregado</span>
                            @endif
                        </td>
                        <td class="hidden align-middle">{{$order->created_at}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#more_{{$order->id}}">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                <span class="hidden">
                                    Más</span>
                            </button>
                            <div class="modal fade" id="more_{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="more_{{$order->id}}Title" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="more_{{$order->id}}Title">{{$user->name}} {{$user->last_name}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Propiedad</th>
                                                                <th>Valor</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>No.orden</td>
                                                                <td>{{$order->id}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Subtotal</td>
                                                                <td>{{$order->subTotal}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>IVA</td>
                                                                <td>{{$order->iva}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total</td>
                                                                <td>{{$order->total}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Estado del pedido</td>
                                                                <td>
                                                                    @if ($order->status ==='PENDING')
                                                                        <span class="text-danger">Por entregar</span>
                                                                    @else
                                                                        <span class="text-success">Entregado</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Fecha del pedido</td>
                                                                <td> {{$order->created_at}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            @if ($order->status ==='PENDING')
                                <button  class="btn  btn-success" data-toggle="modal" data-target="#order_{{$order->id}}"><i class="fa fa-handshake-o" aria-hidden="true"></i>
                                    <span class="hidden">Entregar</span></button>
                                <div class="modal fade" id="order_{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="moreOrder{{$order->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="moreOrder{{$order->id}}">Realizar entrega</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Desea realizar la entrega para la orden número {{$order->id}} a {{$order->user->name}} {{$order->user->last_name}}?
                                                <form action="{{route('admin.order.sended',$order->id)}}" id="orderSended_{{$order->id}}" hidden method="POST">
                                                    @csrf
                                                    @method('put')
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                <a href="javascript:document.getElementById('orderSended_{{$order->id}}').submit()" class="btn btn-success">Sí, entregar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <a href="" class="btn btn-primary my-1 text-center"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                            <span class="hidden">Productos</span></a>
                         </td>
                        </tr>
                       @endforeach
                   @endif
                </tbody>
            </table>
        </div>
        </section>
    </section>
</div>
@endsection