@extends('layouts.main')
@section('title')
    <title>Pedidos - {{$user->name}}</title>
@endsection
@section('section')
<div class="container">
    <div class="row my-4">
        <div class="col-12">
            <p class="text-center h4">Datos del cliente</p>
        </div>
    </div>
    <div class="row my-4 d-flex justify-content-center">
        <div class="col-md-6 col-12 text-center">
            <p class="mb-1"><span class="font-weight-bold">Nombre</span>: {{$user->name}} {{$user->last_name}}</p>
            <p class="mb-1"><span class="font-weight-bold">Estado</span>: {{$user->State->state}}</p>
            <p class="mb-1"><span class="font-weight-bold">Dirección</span>: {{$user->address}}, CP: {{$user->cp}}</p>
            <p><span class="font-weight-bold">Correo electrónico</span>: {{$user->email}}, <span class="font-weight-bold">Teléfono</span>: {{$user->phone}}</p>
        </div>
    </div>
    <section class="row my-4">
        <section class="col-12 mb-3">
            <p class="text-center h4">Pedidos entregados y por entregar</p>
        </section>
        <section class="col-12 table-responsive">
            @if (count($orders))
                <table class="table table-sm table-striped table-hover table-borderless">
                    <thead class="text-center">
                        <tr>                    
                            <th>NO.PEDIDO</th>
                            <th class="hidden">SUBTOTAL</th>
                            <th class="hidden">ENVÍO</th>
                            <th>TOTAL</th>
                            <th>ESTADO</th>
                            <th class="hidden">FECHA</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($orders as $order)
                        <tr>
                            <td class="align-middle">{{$order->id}}</td>
                            <td class="hidden align-middle">$ {{number_format($order->subTotal,2)}}</td>
                            <td class="hidden align-middle">$ {{number_format($order->send,2)}}</td>
                            <td class=" align-middle">$ {{number_format($order->total,2)}}</td>
                            <td class="align-middle">
                                @if ($order->status ==='PENDING')
                                <span class="text-danger">Por entregar</span>
                                @else
                                <span class="text-success">Entregado</span>
                                @endif
                            </td>
                            <td class="hidden align-middle">{{$order->created_at->format('d/m/Y h:m A')}}</td>
                            <td>
                                <button type="button" class="btn btn-muk-cafe" data-toggle="modal" data-target="#more_{{$order->id}}">
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
                                                                    <td>No.pedido</td>
                                                                    <td>{{$order->id}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Subtotal</td>
                                                                    <td>$ {{number_format($order->subTotal,2)}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Envío</td>
                                                                    <td>$ {{number_format($order->send,2)}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Total</td>
                                                                    <td>$ {{number_format($order->total,2)}}</td>
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
                                                                    <td> {{$order->created_at->format('d/m/Y h:m A')}}</td>
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
                                <a href="{{route('admin.list.order',$order->id)}}" class="btn btn-muk-cafe my-1 text-center"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                <span class="hidden">Listar</span></a>
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
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h4 class="text-center">{{$user->name}} no tiene pedidos pendientes.</h4>    
            @endif
        </div>
        </section>
    </section>
</div>
@endsection