@extends('layouts.main')
@section('title')
    <title>Lista de productos</title>
@endsection
@section('section')
<section class="container">
    <div class="row my-4 d-flex justify-content-center">
        <div class="col-md-6 col-12 text-center">
            <p class="h4 mb-0">Datos del cliente</p>
        </div>
    </div>
    <div class="row my-4 d-flex justify-content-center">
        <div class="col-md-6 col-12 text-center">
            <p class="mb-1"><span class="font-weight-bold">Nombre</span>: {{$order->user->name}} {{$order->user->last_name}}</p>
            <p class="mb-1"><span class="font-weight-bold">Dirección</span>: {{$order->user->address}}, CP: {{$order->user->cp}}</p>
            <p><span class="font-weight-bold">Correo electrónico</span>: {{$order->user->email}}, <span class="font-weight-bold">Teléfono</span>: {{$order->user->phone}}</p>
        </div>
    </div>
    <section class="row my-4">
        <div class="col-12 mb-3">
            <p class="text-center h4">Productos del pedido {{$order->id}}</p>
        </div>
        <div class="col-12 table-responsive">
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
                            <td class="align-middle">
                                @if ($product->categories->id_SubCategory != null)
                                    {{$product->categories->Subcategory->description}}
                                @else
                                    {{$product->categories}}
                                @endif
                            </td>
                            <td class="align-middle">{{$product->Unit->description}}</td>
                            <td class="align-middle">{{$product->pivot->quantity}}</td>
                            <td class="align-middle">$ {{number_format($product->pivot->price_sold,2)}}</td>
                            <td class="align-middle">$ {{number_format($product->pivot->total,2)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <section class="row">
        <div class="col-12">
            <h4 class="text-center"><span class="badge">Subtotal: $ {{number_format($order->subTotal,2)}}</span></h4>
            <h4 class="text-center"><span class="badge">Envío: $ {{number_format($order->send,2)}}</span></h4>
        </div>
        <div class="col-12">
            <h4 class="text-center">
                <span class="badge">Total: $ {{number_format($order->total,2)}}</span>
            </h4>
        </div>
    </section>
</section>
@endsection