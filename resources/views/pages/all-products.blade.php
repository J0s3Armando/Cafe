@extends('layouts.main')
@section('title')
    <title>Todos los productos</title>
@endsection
@section('section')
    <section class="container">
        <div class="row my-4">
            <div class="col">
                <h3 class="text-center">Nuestros productos</h3>
                <p class="text-center">Siéntete libre de ver todos nuestros productos</p>
            </div>
        </div>
        <div class="row my-4 d-flex justify-content-center">
            @foreach ($products as $product)
             <div style="width:15em;" class="m-2">
                <div class="card">
                    <div class="overflow-hidden w-100" style="height: 10em !important;">
                        <img src="{{ asset($product->image) }}" class="card-img-top d-block">
                    </div>
                    <div class="card-body">
                    <p class="card-title mb-0 small muk-title">CAFÉ<span class="font-weight-bold">MUKULUM</span></p>
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
        <div class="row">
            <div class="col-12 justify-content-center d-flex">
                {{$products->render()}}
            </div>
        </div>
    </section>
@endsection