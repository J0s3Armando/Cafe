@extends('layouts.main')
@section('title')
    <title>Pedidos</title>
@endsection
@section('section')
    <section class="container">
        <section class="row my-4">
            <div class="col-12">
                <h3 class="text-center">Pedidos por entregar</h3>
            </div>
        </section>
        @if(session('info'))
            <div class="alert alert-success mt-3 mb-0 alert-dismissible fade show" role="alert">
                {{session('info')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
         @endif
        <section class="row my-4">
            <section class="col-12 table-responsive-sm">
                <table class="table table-sm table-striped table-hover table-borderless">
                    <thead class="text-center">
                        <tr>                    
                            <th>#</th>
                            <th>CLIENTE</th>
                            <th class="hidden">SUBTOTAL</th>
                            <th class="hidden">ENVÍO</th>
                            <th>TOTAL</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                       @if (!is_null($orders))
                           @foreach ($orders as $order)
                           <tr>
                            <td class="align-middle">{{$order->id}}</td>
                            <td class="align-middle">{{$order->User->name}} {{$order->User->last_name}}</td>
                            <td class="hidden align-middle">$ {{number_format($order->subTotal,2)}}</td>
                            <td class="hidden align-middle">$ {{number_format($order->send,2)}}</td>
                            <td class="align-middle">$ {{number_format($order->total,2)}}</td>
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
                                            <h5>{{$order->User->name}} {{$order->User->last_name}}</h5>
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
                                                                    <td>Sub-Total</td>
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
                                                                    <td class="align-middle">Estado del pedido</td>
                                                                    <td class="align-middle">
                                                                        @if ($order->status ==='PENDING')
                                                                            <span class="text-danger">Por entregar</span>
                                                                        @else
                                                                            <span class="text-success">Entregado</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="align-middle">Fecha del pedido</td>
                                                                    <td class="align-middle"> {{$order->created_at->format('d/m/y h:i A')}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="align-middle">Dirección</td>
                                                                    <td class="align-middle">{{$order->user->State->state}} ,{{$order->user->address}}, CP: {{$order->User->cp}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="align-middle">Contácto</td>
                                                                    <td class="align-middle">{{$order->user->email}}, Tel: {{$order->User->phone}}</td>
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
                                <a href="{{route('admin.download.order',$order->id)}}" class="btn btn-muk-cafe-active my-1"><i class="fa fa-download" aria-hidden="true"></i>
                                    <span class="hidden">Pedido</span></a>
                                @if ($order->status ==='PENDING')
                                    <button  class="btn  btn-success" data-toggle="modal" data-target="#order_{{$order->id}}"><i class="fa fa-handshake-o" aria-hidden="true"></i>
                                        <span class="hidden">Entregar</span>
                                    </button>
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
                                    <button  class="btn  btn-danger" data-toggle="modal" data-target="#orderCancel_{{$order->id}}"><i class="fa fa-window-close" aria-hidden="true"></i>
                                        <span class="hidden">Cancelar</span>
                                    </button>
                                    <div class="modal fade" id="orderCancel_{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="moreOrderCancel{{$order->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="moreOrderCancel{{$order->id}}">Cancelar pedido</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Desea cancelar la orden número {{$order->id}} a {{$order->user->name}} {{$order->user->last_name}}?
                                                    <form action="{{route('cancelOrder',$order->id)}}" id="orderCanceled_{{$order->id}}" hidden method="POST">
                                                        @csrf
                                                        @method('put')
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                                                    <a href="javascript:document.getElementById('orderCanceled_{{$order->id}}').submit()" class="btn btn-danger">Si, cancelar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                             </td>
                            </tr>
                           @endforeach
                       @endif
                    </tbody>
                </table>
            </section>
        </section>
        <div class="row">
            <div class="col-12 justify-content-center d-flex">
                {{$orders->render()}}
            </div>
        </div>
    </section>
@endsection