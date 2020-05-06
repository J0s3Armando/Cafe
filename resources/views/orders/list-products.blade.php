@extends('layouts.main')
@section('title')
    <title>Lista de productos</title>
@endsection
@section('section')
<section class="container">
    <section class="row my-4">
        <div class="col-12">
            <h3 class="text-center">Productos del pedido</h3>
        </div>
    </section>
    <section class="row my-4">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-hover table-borderless">
                    <thead class="text-center">
                        <tr>
                            <th>TIPO</th>
                            <th>UNIDAD</th>
                            <th class="hidden">PIEZAS</th>
                            <th>PRECIO</th>
                            <th class="hidden">SUBTOTAL</th>
                            <th>DETALLES</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($products as $product)
                            <tr>
                                <td class="align-middle">{{$product->description}}</td>
                                <td class="align-middle">{{$product->Unit->description}}</td>
                                <td class="hidden align-middle">{{$product->pivot->quantity}}</td>
                                <td class="align-middle">$ {{number_format($product->pivot->price_sold,2)}}</td>
                                <td class="hidden align-middle">$ {{number_format($product->pivot->total,2)}}</td>
                                <td class="align-middle">
                                    <button type="button" class="btn btn-muk-cafe" data-toggle="modal" data-target="#more_{{$product->id}}">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        <span class="hidden">
                                            Más</span>
                                    </button>
                                    <div class="modal fade" id="more_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="more_{{$product->id}}Title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="more_{{$product->id}}Title">{{$product->description}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <table class="table table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Propiedad</th>
                                                                        <th>Valor</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="align-middle">Unidad</td>
                                                                        <td class="align-middle">{{$product->Unit->description}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="align-middle">Piezas</td>
                                                                        <td class="align-middle">{{$product->pivot->quantity}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="align-middle">Precio</td>
                                                                        <td class="align-middle">$ {{number_format($product->pivot->price_sold,2)}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="align-middle">Total</td>
                                                                        <td class="align-middle">$ {{number_format($product->pivot->total,2)}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="align-middle">Imágen</td>
                                                                        <td class="align-middle">
                                                                            <img src="{{asset($product->image)}}" class="img-fluid w-75" alt="">
                                                                        </td>
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-12">
            <h2 class="text-center"><span class="badge muk-color-cafe">Total: $ {{number_format($total,2)}}</span></h2>
        </div>
    </div>
</section>
@endsection