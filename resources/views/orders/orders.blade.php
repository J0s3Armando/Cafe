@extends('layouts.main')
@section('title')
    <title>Pedidos</title>
@endsection
@section('section')
<div class="container">
    @if(session('info'))
        <div class="alert alert-success mt-3 mb-0 alert-dismissible fade show" role="alert">
            {{session('info')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <section class="row my-4">
        <section class="col-12 mb-3">
            <h3 class="text-center">Mis pedidos</h3>
        </section>
        <section class="col-12 table-responsive">
            <table class="table table-sm table-striped table-hover table-borderless">
                <thead class="text-center">
                    <tr>                    
                        <th>PEDIDO</th>
                        <th class="hidden">SUBTOTAL</th>
                        <th class="hidden">ENVÍO</th>
                        <th>TOTAL</th>
                        <th>ESTADO</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                   @if (!is_null($orders))
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
                                    <h5 class="modal-title" id="more_{{$order->id}}Title">{{$order->user->name}} {{$order->user->last_name}}</h5>
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
                            <a href="{{route('user.list.order',$order->id)}}" class="btn btn-muk-cafe-active my-1 text-center"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                            <span class="hidden">Listar</span></a>
                         </td>
                        </tr>
                       @endforeach
                   @endif
                </tbody>
            </table>
        </section>
    </section>
    <section class="row">
        <div class="col">
            <p class="text-center mb-0">
                Si tu pedido ya no se encuentra en la lista, esque ya está en camino.
            </p>
            <p class="text-center">Contáctanos para más información acerca de tu pedido.</p>
        </div>
    </section>
</div>
@endsection