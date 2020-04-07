@extends('layouts.main')
@section('tittle')
    <title>{{$product->name}}</title>
@endsection
@section('section')
    <section class="container"> 
       <div class="row my-4 mx-4">
           <section class="col-6 d-flex align-items-center"> <!-- image section -->
                <div>
                    <img src="{{ asset($product->image)}}" alt="{{$product->name}}" class="w-100">
                </div>
           </section>
           <section class="col-6"> <!-- product information -->
                <h4>{{$product->name}}</h4>
                <p>${{$product->price}} MXN</p>
                <p>{{$product->long_description}}</p>
                <div class="w-100">
                    <form action="" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="number" name="id" hidden value="{{$product->id}}" >
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="10">
                        </div>
                        <div class="form-group">
                           <input type="submit" value="Agregar compra" class="btn btn-outline-secondary btn-sm">
                        </div>
                    </form>
                </div>
           </section>
       </div>
    </section>
@endsection
