@extends('layouts.main')
@section('title')
    <title>Carrito de compras</title>
@endsection 
@section('section')
   <section class="container">
    @if(session('info'))
        <div class="alert alert-success mt-3 mb-0 alert-dismissible fade show" role="alert">
            {{session('info')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <section class="row my-4">
        @if (count($products))
            <div class="col-12 mb-3">
                <p class="text-center h4">Productos agregados al carrito</p>
                <p class="text-center">
                    <button  class="btn  btn-muk-cafe" data-toggle="modal" data-target="#clearCart"><i class="fa fa-trash" aria-hidden="true"></i>
                        <span class="hidden">Vaciar el carrito</span></button>
                </p>
                    <div class="modal fade" id="clearCart" tabindex="-1" role="dialog" aria-labelledby="moreclearCart" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="moreclearCart">Vaciar carrito</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Está seguro de que deseas vaciar el carrito?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                <a href="{{route('clear.cart')}}" class="btn btn-danger">Sí, vaciar</a>
                            </div>
                            </div>
                        </div>
                    </div>
            </div>	
            @if ($errors->has('quantity'))
                <div class="col-12">
                    <div class="alert alert-danger my-3 alert-dismissible fade show" role="alert">
                        {{ $errors->first('quantity') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            <div class="col-12 table-responsive mb-4">
                <table class="table table-sm table-striped table-hover table-borderless">
                    <thead class="text-center">
                        <tr>
                            <th>TIPO</th>
                            <th>UNIDAD</th>
                            <th>PRECIOS</th>
                            <th>PIEZAS</th>
                            <th>SUBTOTAL</th>
                            <th>QUITAR</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($products as $product)
                            <tr>
                                <td class="align-middle">{{$product->description}}</td>
                                <td class="align-middle">{{$product->Unit->description}}</td>
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
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <form id="prod_{{$product->id}}" action="{{route('update.qty.prod.cart',$product->id)}}" method="post" style="width:3em;">
                                            @csrf
                                            @method('put')
                                            <input type="number" required min="1" max="{{$product->stock}}"  class="form-control p-1" name="quantity" value="{{old('quantity',$product->quantity)}}">
                                        </form>
                                        <a href="javascript:document.getElementById('prod_{{$product->id}}').submit()" 
                                        class="btn btn-muk-cafe mx-1"><i class="fa fa-refresh" aria-hidden="true"></i>
                                        </a>
                                    </div>
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
                                <td class="align-middle" colspan="2">
                                    <button  class="btn  btn-muk-cafe-active" data-toggle="modal" data-target="#delete_{{$product->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    <div class="modal fade" id="delete_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="moreDelete{{$product->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="moreDelete{{$product->id}}">{{$product->description}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Deseas quitar este producto de la lista?
                                                <form action="{{route('cart.drop.item',$product->id)}}" id="product_{{$product->id}}" hidden method="POST">
                                                    @csrf
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                <a href="javascript:document.getElementById('product_{{$product->id}}').submit()" class="btn btn-success">Sí, quitar</a>
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
            <div class="col-12 my-4">
               
                <h2 class="text-center" ><span class="badge muk-color-cafe">Total: $ {{number_format($total, 2) }}</span></h2>
            
            </div>
            <div class="col-12 my-4">
                <p class="text-center">
                    <a href="{{route('cart.detail')}}" class="btn btn-muk-cafe-active">Continuar <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </p>
            </div>
        @else
            <div class="col-12 my-4">
                <h2 class="text-center text-muted"> No hay productos en el carrito :C</h2>
                <p class="text-center">Agrega productos al carrito. <a href="{{route('show.all.products')}}" class="text-center muk-link-cafe">Ver productos</a></p>
            </div>
        @endif
    </section>
   </section>
@endsection