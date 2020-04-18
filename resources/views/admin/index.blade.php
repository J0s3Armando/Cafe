@extends('layouts.main')
@section('title')
    <title>Panel de administración</title>
@endsection
@section('section')
    <section class="container">
        <div class="row my-4">
            <div class="col">
                <div class="card">
                    <div class="card-header flex-column flex-md-row d-flex align-content-center justify-content-md-around ">
                        <p>Bienvenido {{Auth::user()->name}}</p>
                        <div class="grow-1">
                            <a href="{{route('panel.admin.create-product')}}" class="btn btn-sm btn-primary">Agregar producto</a>
                            <a href="" class="btn btn-sm btn-primary">Nuevo administrador</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('admin.info'))
                            <div class="alert alert-success mt-3 mb-0 alert-dismissible fade show" role="alert">
                                {{session('admin.info')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                     <table class="table table-sm table-striped table-hover table-borderless">
                            <thead class="text-center">
                                <tr>
                                    <th>Descripción</th>
                                    <th class="hidden">Código</th>
                                    <th class="hidden">Stock</th>
                                    <th class="hidden">Precio</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="align-middle">{{$product->description}}</td>
                                        <td class="hidden align-middle">{{$product->code}}</td>
                                        <td class="hidden align-middle">{{$product->stock}}</td>
                                        <td class="hidden align-middle">{{$product->price}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#more_{{$product->id}}">
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
                                                                                <td>Stock</td>
                                                                                <td>{{$product->stock}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Código</td>
                                                                                <td>{{$product->code}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Precio</td>
                                                                                <td>{{$product->price}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Categoría</td>
                                                                                <td>{{$product->categories->category}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Descripción</td>
                                                                                <td> {{$product->long_description}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Imágen</td>
                                                                                <td>
                                                                                    <img src="{{asset($product->image)}}" class="img-fluid w-100" alt="">
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
                                            <a href="{{route('admin.edit.product',$product->id)}}" class="btn btn-warning my-1"><i class="fa fa-pencil" aria-hidden="true"></i>
                                                <span class="hidden">Editar</span></a>
                                            <button  class="btn  btn-danger" data-toggle="modal" data-target="#delete_{{$product->id}}"><i class="fa fa-trash" aria-hidden="true"></i>
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
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                        <a href="javascript:document.getElementById('product_{{$product->id}}').submit()" class="btn btn-success">Sí, eliminar</a>
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
            </div>
        </div>
    </section>
@endsection
