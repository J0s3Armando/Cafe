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
       <h4 class="text-center font-weight-light">Algunos de nuestros productos más populares.
          <a href="#" class="small">Ver todos</a>
       </h4>
     </div>
     <div class="col-12 popular w-100">
       <div id="btnLeft" onclick="slideLeft()" class="left"><i class="fa fa-chevron-circle-left h2" aria-hidden="true"></i>
       </div>
       <div class="flex-grow-1 items mx-2" id="items">
            @foreach ($products as $product)
              <div class="mx-1">
                <div class="card">
                  <img src="{{ asset($product->image) }}" class="card-img-top">
                  <div class="card-body">
                    <p class="card-title h6 mb-0">${{$product->price}} MXN</p>
                    <p class="card-text  text-muted">{{$product->description}}</p>
                    <a href="javascript:document.getElementById('product-{{$product->id}}').submit()" class="btn btn-outline-secondary btn-sm btn-block">Comprar</a>
                    <form id="product-{{$product->id}}" action="{{route('product.info',$product->id)}}" method="GET" hidden>@csrf</form>
                  </div>
                </div>
              </div>
            @endforeach   
       </div>
       <div id="btnRight" onclick="slideRight()" class="right"><i class="fa fa-chevron-circle-right h2" aria-hidden="true"></i>
       </div>
     </div>
   </section>
 </section>

 <section class="jumbotron bg-light mt-5 mb-5 pt-3 pb-5">
    <div class="container">
      <section class="row mt-5 d-flex justify-content-center">
        <div class="col-12 mb-4">
          <h2 class="text-center font-weight-light">Visítanos</h2>
          <p class="text-center font-weight-light">En nuestros distintos puntos de venta en Sancristobal De Las Casas y Tuxtla Gutiérrez, Chiapas.</p>
        </div>

        <div class="col-lg-7 d-flex w-100 align-items-center" id="map">
           
        </div>
        <div class="col-lg-5 text-center ">
          <p class="h2 mb-4"><i class="fa fa-map-marker text-danger" aria-hidden="true"></i>
          </p>
          <p class="h4 text-center">Sancristobal De Las Casas</p>
          <p> <button type="button" class="btn btn-outline-secondary" id="local1" name="button">Marchante, Mercadito Culinario</button> </p>
          <p class="h4 text-center">Tuxtla Gutiérrez</p>
          <p> <button type="butgit ton" class="btn btn-outline-secondary" id="local2" name="button">Hotel Hilton Garden Inn</button> </p>
          <p> <button type="button" class="btn btn-outline-secondary" id="local21" name="button">Amor A Chiapas Bazar</button> </p>
          
        </div>
      </section>
    </div>
 </section>

 <section class="container">
   <div class="row">
     <div class="col-12 mb-4">
       <p class="h2 font-weight-light text-center">Nuestros servicios</p>
     </div>
     <div class="col-lg-3 col-md-6 col-sm-8 col-12">
        <div class="card">
          <div class="card-body">
              <p class="text-center h2 mb-0"><i class="fa fa-bus" aria-hidden="true"></i>
              </p>
          </div>
          <div class="card-body">
          <p class="text-center">Servicio a domicilio</p>
          </div>
        </div>
     </div>
   </div>
 </section>

@endsection
