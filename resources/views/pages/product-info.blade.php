@extends('layouts.main')
@section('title')
    <title>{{$product->description}}</title>
@endsection
@section('section')
    <section class="container"> 
       <div class="row my-4 mx-1">
           <section class="col-md-6 col-sm-10 col-xs-12 d-flex mx-auto align-items-center"> <!-- image section -->
                <div class="w-100">
                    <img src="{{ asset($product->image)}}" alt="{{$product->description}}" class="img-fluid">
                </div>
           </section>
           <section class="col-md-6 col-12 mt-4"> <!-- information of product-->
                <h5 class="card-title muk-title muk-color-cafe">CAFÉ<span class="font-weight-bold">MUKULUM</span></h5>
                <h4>{{$product->description}}</h4>
                <p class="h5 text-success">$ {{$product->price}} MXN</p>
                <p>cont.{{$product->unit->description}}</p>
                @if (($product->wholesale_price && $product->quantity_wholesale_price) !=null)
                  <p class="h5">Aplica mayoreo</p>
                  <p class="h6 text-success">Comprando {{$product->quantity_wholesale_price}} ó más a $ {{$product->wholesale_price}} MXN c/u</p>
                @endif
                <p>Disponibles {{$product->stock}}</p>
                <div class="w-100 mt-3">
                    <form action="{{route('add.product.cart',$product->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="col-lg-6 col-md-10 col-12 p-0">
                                <input type="number" name="quantity" class="form-control" id="quantity" value="1" min="1" max="{{$product->stock}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6 col-md-10 col-12 p-0">
                                <input type="submit" value="Agregar compra" class="btn-block btn btn-muk-cafe">
                            </div>
                        </div>
                    </form>
                </div>
           </section>
       </div>
       <div class="row d-flex justify-content-center my-4">
            <div class="col-md-6 col-12">
                <h2 class="text-center">Descripción del producto</h2>
                <p class="text-center">{{$product->long_description}}</p>
            </div>
       </div>
    </section>
@endsection
