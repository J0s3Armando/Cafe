@extends('layouts.main')
@section('title')
    <title>Pedidos</title>
@endsection
@section('section')
    <section class="container">
        <section class="row my-4">
            <div class="col-12">
                <h4 class="text-center">Pedidos</h4>
            </div>
        </section>
        <section class="row my-4">
            <section class="col-12">
                <table class="table table-sm table-striped table-hover table-borderless">
                    <thead class="text-center">
                        <tr>                    
                            <th>No.pedido</th>
                            <th>Cliente</th>
                            <th class="hidden">Total</th>
                            <th class="hidden">Estado</th>
                            <th class="hidden">Fecha</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                       @if (!is_null($orders))
                           @foreach ($orders as $order)
                           <tr>
                            <td class="align-middle">{{$order->id}}</td>
                            <td class="align-middle">{{$order->User->name}} {{$order->User->last_name}}</td>
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
                                                                    <td>Sub-Total</td>
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
                                                                <tr>
                                                                    <td>Dirección</td>
                                                                    <td> {{$order->user->address}}, CP: {{$order->User->cp}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Contácto</td>
                                                                    <td>{{$order->user->email}}, Tel: {{$order->User->phone}}</td>
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
                                <span class="hidden">Listar</span></a>
                             </td>
                            </tr>
                           @endforeach
                       @endif
                    </tbody>
                </table>
            </section>
        </section>
    </section>
@endsection