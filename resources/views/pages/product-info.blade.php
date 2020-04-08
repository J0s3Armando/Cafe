@extends('layouts.main')
@section('title')
    <title>{{$product->name}}</title>
@endsection
@section('section')
    <section class="container"> 
       <div class="row my-4 mx-4">
           <section class="col-md-6 col-sm-10 col-xs-12 d-flex mx-auto align-items-center"> <!-- image section -->
                <div class="w-100">
                    <img src="{{ asset($product->image)}}" alt="{{$product->name}}" class="img-fluid">
                </div>
           </section>
           <section class="col-md-6 col-12 mt-4"> <!-- product information -->
                <h4>{{$product->name}}</h4>
                <p>${{$product->price}} MXN</p>
                <p>{{$product->long_description}}</p>
                <div class="w-100">
                    <form action="" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="col-lg-6 col-md-10 col-12 p-0">
                                <input type="number" name="id" hidden value="{{$product->id}}" >
                                <input type="number" name="quantity" class="form-control" id="quantity" value="1" min="1" max="10">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6 col-md-10 col-12 p-0">
                                <input type="submit" value="Agregar compra" class="btn-block btn btn-outline-secondary">
                            </div>
                        </div>
                    </form>
                </div>
           </section>
       </div>
    </section>
@endsection
