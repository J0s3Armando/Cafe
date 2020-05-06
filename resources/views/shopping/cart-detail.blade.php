@extends('layouts.main')
@section('title')
    <title>Detalles de la compra</title>
@endsection 
@section('section')
<section class="container">
    <section class="row my-4">
        <div class="col-12">
            <h4 class="text-center">Datos para el envío</h4>
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
        <div class="col-12 table-responsive mb-4">
            <table class="table table-sm table-borderless table-hover">
                <tbody class="text-center">
                    <tr>
                        <td class="align-middle">Nombre</td>
                        <td class="align-middle">{{$user->name}} {{$user->last_name}}</td>
                    </tr> 
                    <tr>
                        <td class="align-middle">Dirección</td>
                        <td class="align-middle">{{$user->address}}</td>
                    </tr>  
                    <tr>
                        <td class="align-middle">Correo electrónico</td>
                        <td class="align-middle">{{$user->email}}</td>
                    </tr>            
                    <tr>
                        <td class="align-middle">Teléfono</td>
                        <td class="align-middle">{{$user->phone}}</td>
                    </tr>  
                </tbody>
            </table>
        </div>
    </section>
    <section class="row my-4">
        <div class="col-12">
            <h4 class="text-center">Detalles del pedido</h4>
        </div>
    </section>
    <section class="row my-4">
        <div class="col-12 table-responsive mb-4">
            <table class="table table-sm table-striped table-hover table-borderless">
                <thead class="text-center">
                    <tr>
                        <th>TIPO</th>
                        <th>UNIDAD</th>
                        <th>PIEZAS</th>
                        <th>PRECIOS</th>
                        <th>SUBTOTAL</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($products as $product)
                        <tr>
                            <td class="align-middle">{{$product->description}}</td>
                            <td class=" align-middle">{{$product->Unit->description}}</td>
                            <td class="align-middle">{{$product->quantity}}
                            </td>
                            <td class="align-middle">$
                                @if (($product->wholesale_price && $product->quantity_wholesale_price) != null)
                                    @if ($product->quantity >= $product->quantity_wholesale_price)
                                        <span class="text-success">{{$product->wholesale_price}}</span>
                                    @else
                                        {{$product->price}}
                                    @endif
                                @else
                                    {{$product->price}}
                                @endif
                            </td>
                            <td class="align-middle">$ 
                                @if (($product->wholesale_price && $product->quantity_wholesale_price) != null)
                                    @if ($product->quantity >= $product->quantity_wholesale_price)
                                        <span class="text-success">{{number_format( $product->wholesale_price * $product->quantity,2)}}</span>
                                    @else
                                        {{number_format ($product->price * $product->quantity,2)}}
                                    @endif
                                @else
                                    {{number_format($product->price * $product->quantity,2)}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12 my-4">
            
            <h4 class="text-center" >
                <span class="badge ">Sub-Total: $ {{number_format($total, 2) }}</span>
                <span class="badge">Costo de envío: $ {{number_format($costSend, 2) }}</span>
            </h4>
            <h4 class="text-center">
                <span class="badge badge-success">Total a pagar: $ {{number_format($total+$costSend, 2) }}</span>
            </h4>
        
        </div>
        <div class="col-12 my-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-12">
                    <p class="text-center">
                        Verifique sus datos y los detalles de los productos agregados al carrito 
                        antes de continuar con el proceso de realización del pedido.
                    </p>
                </div>
            </div>
            <p class="text-center">
                <button type="button" class="btn btn-muk-cafe-active" data-toggle="modal" data-target="#make_order">
                    Realizar pedido 
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </button>
                <div class="modal fade" id="make_order" tabindex="-1" role="dialog" aria-labelledby="make_order_title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Realizar pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            ¿Deseas realizar el pedido?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <a href="{{route('new.order')}}" class="btn btn-success">Aceptar
                        </a>
                        </div>
                    </div>
                    </div>
                </div>
            </p>
        </div>
    </section>
   </section>
@endsection