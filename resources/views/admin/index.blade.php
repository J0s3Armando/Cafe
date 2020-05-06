@extends('layouts.main')
@section('title')
    <title>Panel de administración</title>
@endsection
@section('section')
    <section class="container">
        <div class="row my-4">
            <div class="col-12 my-4">
                <p class="text-center h4">Bienvenido {{Auth::user()->name}}</p>
                <div class="d-flex justify-content-center flex-wrap">
                    <a href="{{route('admin.units.view')}}" class="btn btn-muk-cafe-active m-1">Unidades del producto</a>
                    @if (Auth::user()->autorize(1))
                    <a href="{{route('panel.admin.create-product')}}" class="btn btn-muk-cafe-active m-1">Agregar producto</a>
                    @endif
                    <a href="{{route('admin.users')}}" class="btn btn-muk-cafe-active m-1">Usuarios</a>
                    <a href="{{route('admin.carousel.view')}}" class="btn btn-muk-cafe-active m-1">Carrusel de imágenes</a>
                    <a href="{{route('admin.categories.view')}}" class="btn btn-muk-cafe-active m-1">Categorías</a>
                    <a href="{{route('admin.orders.view')}}" class="btn btn-muk-cafe-active m-1">Pedidos</a>
                </div>
            </div>
        </div>
        @if(session('info'))
            <div class="alert alert-success mt-3 mb-0 alert-dismissible fade show" role="alert">
                {{session('info')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
         @endif
        <section class="row">
            <div class="col-12 mb-3">
                <p class="text-center h4">Productos registrados</p>
            </div>
            <div class="col-12 table-responsive">
                <table class="table table-sm table-striped table-hover table-borderless">
                    <thead class="text-center">
                        <tr>
                            <th class="hidden">DESCRIPCIÓN</th>
                            <th>TIPO</th>
                            <th class="hidden">UNIDAD</th>
                            <th class="hidden">ALMACÉN</th>
                            <th class="hidden">PRECIOS</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($products as $product)
                            <tr>
                                <td class="align-middle hidden">{{$product->description}}</td>
                                <td class="align-middle">
                                    @if ($product->categories->id_SubCategory != null)
                                     {{$product->categories->Subcategory->description}}
                                    @else
                                        {{$product->categories}}
                                    @endif
                                </td>
                                <td class="hidden align-middle">{{$product->unit->description}}</td>
                                <td class="hidden align-middle">{{$product->stock}}</td>
                                <td class="hidden align-middle">$ {{number_format($product->price,2)}}</td>
                                <td>
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
                                                            
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Propiedad</th>
                                                                        <th>Valor</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="align-middle">Almacén</td>
                                                                        <td class="align-middle">{{$product->stock}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="align-middle">Código</td>
                                                                        <td class="align-middle">{{$product->code}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="align-middle">Precio</td>
                                                                        <td class="align-middle">$ {{number_format($product->price,2)}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="align-middle">Precio al mayoreo</td>
                                                                        <td class="align-middle">$
                                                                            @if ($product->wholesale_price !=null)
                                                                                {{number_format($product->wholesale_price)}}
                                                                            @else
                                                                                -----
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="align-middle">Aplicable al mayoreo</td>
                                                                        <td class="align-middle"> 
                                                                            @if ($product->quantity_wholesale_price !=null)
                                                                                {{$product->quantity_wholesale_price}}
                                                                            @else
                                                                                -----
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="align-middle">Tipo</td>
                                                                        <td class="align-middle">
                                                                            @if ($product->categories->id_SubCategory != null)
                                                                                {{$product->categories->Subcategory->description}}
                                                                            @else
                                                                                {{$product->categories}}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="align-middle">Unidad</td>
                                                                        <td class="align-middle">{{$product->unit->description}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="align-middle">Descripción</td>
                                                                        <td class="align-middle">{{$product->long_description}}</td>
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
                                    <a href="{{route('admin.edit.product',$product->id)}}" class="btn btn-muk-cafe my-1"><i class="fa fa-pencil" aria-hidden="true"></i>
                                        <span class="hidden">Editar</span></a>
                                    @if (Auth::user()->autorize(1))
                                        <button  class="btn  btn-outline-danger" data-toggle="modal" data-target="#delete_{{$product->id}}"><i class="fa fa-trash" aria-hidden="true"></i>
                                            <span class="hidden">Eliminar</span></button>
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
                                                    ¿Está seguro de que desea eliminar este producto?
                                                    <form action="{{route('admin.delete.product',$product->id)}}" id="product_{{$product->id}}" hidden method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                                    <a href="javascript:document.getElementById('product_{{$product->id}}').submit()" class="btn btn-danger">Sí, eliminar</a>
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
            </div>
            
        </section>
    </section>
@endsection
