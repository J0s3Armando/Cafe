@extends('layouts.main')
@section('title')
    <title>Editar Categoría</title>
@endsection
@section('section')
    <section class="container">
        <div class="row my-4">
            <div class="col">
                <div class="col-12 mb-3">
                    <p class="text-center h4">Usted está editando la categoría "{{$category->category}}"</p>
                </div>
            </div>
        </div>
        <div class="row my-4 d-flex justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.edited.category',$category->id)}}" id="formCategory" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="category" class="col-md-12 col-form-label text-md-center">Categoría</label>
                                <div class="col-md-12">
                                    <input type="text" id="category"  placeholder="Actualize la categoría"
                                    minlength="3" maxlength="50" class="form-control @error('category') is-invalid @enderror"
                                    name="category" value="{{ old('category',$category->category) }}" autocomplete="category" autofocus>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_SubCategory" class="col-md-12 col-form-label text-md-center">Seleccione una subcategoría</label>
                                <div class="col-md-12">    
                                    <select name="id_SubCategory" class="form-control" id="id_SubCategory">
                                        @if ($category->id_SubCategory == null)
                                            <option value="" selected disabled>Sin valor</option>
                                        @else   
                                            <option value="">Sin valor</option>
                                        @endif
                                        @foreach ($subCategories as $subCategory)
                                            @if ($category->id_SubCategory == $subCategory->id)
                                                 <option value="{{$subCategory->id}}" selected>{{$subCategory->description}}</option>
                                            @else 
                                                <option value="{{$subCategory->id}}">{{$subCategory->description}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('id_SubCategory')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-4  justify-content-center d-flex">                           
                                <div class="col-md-6 justify-content-center d-flex">
                                <input type="submit" value="Agregar" disabled="true" id="btnCategory" class="btn btn-muk-cafe">
                                </div>
                            </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts') 
    <script>
        document.getElementById('formCategory').onchange=function(e)
        {
            document.getElementById('btnCategory').disabled=false;
        }
    </script>
@endsection