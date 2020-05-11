@extends('layouts.main')
@section('title')
    <title>Imágenes del sitio</title>
@endsection
@section('section')
<section class="container">
    <div class="row my-4">
        <div class="col-12 my-4">
           <p class="text-center h4">Administre las imágenes del sitio</p>
            @if (Auth::user()->autorize(1))
            <div class="d-flex justify-content-center">
                <a href="{{route('image.add.image')}}" class="btn btn-muk-cafe-active">Agregar nueva imágen</a>
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
    </section>

    <div class="row my-4">
        <div class="col-12">
            <h2 class="text-center">Carrusel</h2>
        </div>
        @if (count($carousels))
            <div class="col-12 popular w-100">
                <div id="btnLeft" onclick="slideLeftCarousel()" class="left btn-cafe"><i class="fa fa-chevron-circle-left h2" aria-hidden="true"></i>
                </div>
                <div class="flex-grow-1 items mx-2" id="carousel">
                    @foreach ($carousels as $carousel)
                        <section class="mx-1">
                            <div class="card">
                                <div class="w-100 overflow-hidden" style="height: 10em !important;">
                                    <img src="{{asset($carousel->image)}}" class="img-fluid" alt="{{$carousel->title}}">
                                </div>
                                <section class="card-body">
                                    <p class="card-title font-weight-bold  text-truncate">{{$carousel->title}}</p>
                                    <p class="card-text text-center mb-1 text-truncate">{{$carousel->description}}</p>
                                    <section class="d-flex justify-content-center">
                                        <a href="{{route('admin.edit.image',$carousel->id)}}" class="btn muk-color-cafe"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
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
                                                        <form action="{{route('admin.delete.image',$carousel->id)}}" id="product_{{$carousel->id}}" hidden method="POST">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                                        <a href="javascript:document.getElementById('product_{{$carousel->id}}').submit()" class="btn btn-danger">Sí, eliminar</a>
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
                </div>
                <div id="btnRight" onclick="slideRightCarousel()" class="right btn-cafe"><i class="fa fa-chevron-circle-right h2" aria-hidden="true"></i>
                </div>
            </div>
        @else
            <div class="col-12">
                <h5 class="text-center">No hay imágenes en el slider.</h5>
            </div>
        @endif
    </div>
   
    <div class="row my-4">
        <div class="col-12">
            <h2 class="text-center">Galería</h2>
        </div>
        @if (count($galeries))
            <div class="col-12 popular w-100">
                <div id="btnLeft" onclick="slideLeftGalery()" class="left btn-cafe"><i class="fa fa-chevron-circle-left h2" aria-hidden="true"></i>
                </div>
                <div class="flex-grow-1 items mx-2" id="galery">
                        @foreach ($galeries as $galery)
                            <div class="mx-1">
                                <div class="card" >
                                    <div class="w-100 overflow-hidden" style="height: 10em !important;">
                                        <img src="{{ asset($galery->image) }}" class="card-img-top d-block ">
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text mb-1 font-weight-bold text-truncate">{{$galery->title}}</p>
                                        <p class="card-title mb-1 text-truncate">{{$galery->description}}</p>
                                        <div class="d-flex align-items-center">
                                            <a href="{{route('admin.edit.image',$galery->id)}}" class="btn muk-color-cafe"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
                                        @if(Auth::user()->autorize(1))
                                            <button  class="btn text-danger" data-toggle="modal" data-target="#imagedelete_{{$galery->id}}"><i class="fa fa-trash" aria-hidden="true"></i>
                                                Eliminar</button>
                                            <div class="modal fade" id="imagedelete_{{$galery->id}}" tabindex="-1" role="dialog" aria-labelledby="moreDelete{{$galery->id}}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="moreDelete{{$galery->id}}">{{$galery->title}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Está seguro que deseas eliminar este contenido de la galería?
                                                        <form action="{{route('admin.delete.image',$galery->id)}}" id="image_{{$galery->id}}" hidden method="POST">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                                        <a href="javascript:document.getElementById('image_{{$galery->id}}').submit()" class="btn btn-danger">Sí, eliminar</a>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        @endforeach
                </div>
                <div id="btnRight" onclick="slideRightGalery()" class="right btn-cafe"><i class="fa fa-chevron-circle-right h2" aria-hidden="true"></i>
                </div>
            </div>
        @else
            <div class="col-12">
                <h5  class="text-center">No hay imágenes en la galería.</h5>
            </div>
        @endif
    </div>

</section> 
@endsection

@section('scripts')
    <script>
            function slideRightGalery()
            {
                var scrollbar = document.getElementById('galery');
                scrollbar.scrollLeft +=100;
            }

            function slideLeftGalery()
            {
                var scrollbar = document.getElementById('galery');
                scrollbar.scrollLeft -=100;
            }
            function slideRightCarousel()
            {
                var scrollbar = document.getElementById('carousel');
                scrollbar.scrollLeft +=100;
            }

            function slideLeftCarousel()
            {
                var scrollbar = document.getElementById('carousel');
                scrollbar.scrollLeft -=100;
            }
    </script>
@endsection