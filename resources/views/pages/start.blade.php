@extends('layouts.main')
@section('title')
  <title>Café Mukulum - Inicio</title>
@endsection
@section('section')

<div class="container">
  <div class="row d-flex justify-content-center" >
    <div class="col-lg-10 col-md-12">
      <div id="carouselControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner w-100">
           @for ($i = 0; $i <count($carousels); $i++)
              @if ($i==0)
                <div class="carousel-item active w-100 h-100"> 
              @else
                <div class="carousel-item w-100 h-100"> 
              @endif
                <img src="{{asset($carousels[$i]['image'])}}" class="d-block w-100" alt="">
                <div class="carousel-caption  d-block">
                  <h5>{{$carousels[$i]['title']}}</h5>
                  <p>{{$carousels[$i]['description']}}</p>
                </div>
            </div>
           @endfor
        </div>
        <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</div> 

 <section class="container">
   @if(session('info'))
    <div class="alert alert-success mt-3 mb-0 alert-dismissible fade show" role="alert">
      {{session('info')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
   @endif
   <section class="row mt-5">
     <div class="col-12 mb-4">
       <h4 class="text-center font-weight-light">Nuestros productos.
          <a href="{{route('show.all.products')}}" class="small muk-link-cafe">Ver todos</a>
       </h4>
     </div>
     <div class="col-12 popular w-100">
       <div id="btnLeft" onclick="slideLeft()" class="left btn-cafe"><i class="fa fa-chevron-circle-left h2" aria-hidden="true"></i>
       </div>
       <div class="flex-grow-1 items mx-2" id="items">
            @foreach ($products as $product)
              <div class="mx-1">
                <div class="card">
                  <div class="overflow-hidden w-100" style="height: 10em !important;">
                    <img src="{{ asset($product->image) }}" class="card-img-top d-block">
                  </div>
                  <div class="card-body">
                    <p class="card-title mb-0 small muk-color-cafe muk-title">CAFÉ<span class="font-weight-bold">MUKULUM</span></p>
                    <p class="card-text mb-1 h6">{{$product->description}}</p>
                    <p class="card-title h5 mb-0 text-success">$ {{$product->price}} MXN</p>
                    <p class="mb-0 small mb-2">cont.{{$product->unit->description}}
                    </p>
                    <a href="{{route('product.info',$product->id)}}" class="btn btn-muk-cafe btn-sm btn-block">Comprar</a>
                  </div>
                </div>
              </div>
            @endforeach   
       </div>
       <div id="btnRight" onclick="slideRight()" class="right btn-cafe"><i class="fa fa-chevron-circle-right h2" aria-hidden="true"></i>
       </div>
     </div>
   </section>
 </section>

 <section class="jumbotron bg-light mt-5 mb-5 pt-3 pb-5">
    <div class="container">
      <section class="row mt-5 d-flex justify-content-center">
        <div class="col-12 mb-4">
          <h2 class="text-center font-weight-light">Ven y conócenos</h2>
          <p class="text-center font-weight-light">En nuestros distintos puntos de venta en Sancristobal De Las Casas y Tuxtla Gutiérrez, Chiapas.</p>
        </div>

        <div class="col-lg-7 d-flex w-100 align-items-center" id="map">
           
        </div>
        <div class="col-lg-5 text-center ">
          <p class="h2 mb-4"><i class="fa fa-map-marker text-danger" aria-hidden="true"></i>
          </p>
          <p class="h4 text-center">Sancristobal De Las Casas</p>
          <p> <button type="button" class="btn btn-outline-light" id="local1" name="button">Marchante, Mercadito Culinario</button> </p>
          <p class="h4 text-center">Tuxtla Gutiérrez</p>
          <p> <button type="butgit ton" class="btn btn-outline-light" id="local2" name="button">Hotel Hilton Garden Inn</button> </p>
          <p> <button type="button" class="btn btn-outline-light" id="local21" name="button">Amor A Chiapas Bazar</button> </p>
          
        </div>
      </section>
    </div>
 </section>

 <section class="container">
   <div class="row">
    <div class="col-12 mb-4">
      <p class="h2 font-weight-light text-center">Nuestros servicios</p>
    </div>
   </div>
   <div class="row d-flex justify-content-center">
     <div class="my-3 col-lg-4 col-md-6 col-sm-8 col-12">
        <div class="card">
          <div class="card-body">
              <p class="text-center h2 mb-0"><i class="fa fa-motorcycle" aria-hidden="true"></i>
              </p>
          </div>
          <div class="card-body">
          <p class="text-center">Servicio a domicilio</p>
           <p class="text-center text-justify">
             Si te encuentras cerca o relativamente cerca de nuestros locales, o tienes dudas acerca 
             de nuestro servicio a domicilio contáctanos para aclarar tus dudas.
           </p>
          </div>
        </div>
     </div>
     <div class="my-3 col-lg-4 col-md-6 col-sm-8 col-12">
      <div class="card">
        <div class="card-body">
            <p class="text-center h2 mb-0"><i class="fa fa-bus" aria-hidden="true"></i>
            </p>
        </div>
        <div class="card-body">
        <p class="text-center">Envíos dentro de la república Mexicana</p>
         <p class="text-center text-justify">
           Hacemos envíos dentro de la república Mexicana, realiza tus pedido aquí o si tienes dudas acerca 
           de nuestro servicio de envíos contáctanos para aclarar tus dudas.
         </p>
        </div>
      </div>
   </div>
   </div>
 </section>
 
<section class="container">
  <div class="row my-4">
    <div class="col-12">
      <h2 class="text-center">Galería</h2>
    </div>
    <div class="col-12 popular w-100">
      <div onclick="slideLeftGalery()" class="left btn-cafe"><i class="fa fa-chevron-circle-left h2" aria-hidden="true"></i>
      </div>
      <div class="flex-grow-1 items mx-2" id="galery">
        @foreach ($galeries as $galery)
            <div class="mx-1">
              <div class="card overflow-hidden" style="height: 13em; width: 18em;">
                <a data-toggle="modal" data-target="#galery_{{$galery->id}}">
                  <img alt="{{$galery->title}}" src="{{asset($galery->image)}}"
                    class="d-block w-100">
                </a>
                <div class="modal fade" id="galery_{{$galery->id}}" tabindex="-1" role="dialog" aria-labelledby="galeryTitle_{{$galery->id}}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>{{$galery->title}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                          <img alt="{{$galery->title}}" src="{{asset($galery->image)}}"
                          class="img-fluid">
                        </div>
                        <div class="modal-footer">
                          <div class="container">
                            <p class="text-justify">{{$galery->description}}</p>
                          </div>
                        </div>
                    </div>
                    </div>
                </div>
              </div>
            </div>
        @endforeach
      </div>
      <div  onclick="slideRightGalery()" class="right btn-cafe"><i class="fa fa-chevron-circle-right h2" aria-hidden="true"></i>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>
  <script type="text/javascript" src="{{ asset('js/main.js')}}"></script>
@endsection