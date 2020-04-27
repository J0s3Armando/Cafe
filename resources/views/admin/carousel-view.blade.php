@extends('layouts.main')
@section('title')
    <title>Carrusel de imágenes</title>
@endsection
@section('section')
<section class="container">
    <div class="row my-4">
        <div class="col-12 my-4">
           <p class="text-center h4">Administre las imágenes del carrusel</p>
            @if (Auth::user()->autorize(1))
            <div class="d-flex justify-content-center">
                <a href="{{route('carousel.add.image')}}" class="btn btn-primary">Agregar nueva imágen</a>
            </div>
            @endif
        </div>
    </div>
    @if(session('info'))
        <div class="alert alert-success my-3 alert-dismissible fade show" role="alert">
            {{session('info')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <section class="row justify-content-center d-flex">
        @foreach ($carousels as $carousel)
            <section class="col-lg-3 col-md-4 col-sm-6  col-10 my-2">
            <div class="card">
                <img src="{{asset($carousel->image)}}" class="img-fluid" alt="{{$carousel->title}}">
                <section class="card-body">
                    <p class="card-title text-center h5 font-weight-bold font-weight-lighter">{{$carousel->title}}</p>
                    <p class="card-text text-center mb-1">{{$carousel->description}}</p>
                    <section class="d-flex justify-content-center">
                        <a href="{{route('admin.edit.carousel',$carousel->id)}}" class="btn text-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
                        @if(Auth::user()->autorize(1))
                            <button  class="btn text-danger" data-toggle="modal" data-target="#delete_{{$carousel->id}}"><i class="fa fa-trash" aria-hidden="true"></i>
                                <span class="hidden">Eliminar</span></button>
                            <div class="modal fade" id="delete_{{$carousel->id}}" tabindex="-1" role="dialog" aria-labelledby="moreDelete{{$carousel->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="moreDelete{{$carousel->id}}">{{$carousel->title}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de que desea eliminar este contenido del carrusel?
                                        <form action="{{route('admin.delete.carousel',$carousel->id)}}" id="product_{{$carousel->id}}" hidden method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        <a href="javascript:document.getElementById('product_{{$carousel->id}}').submit()" class="btn btn-success">Sí, eliminar</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </section>
                </section>
            </div>
            </section>
        @endforeach
    </section>
</section> 
@endsection