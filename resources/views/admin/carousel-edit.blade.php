@extends('layouts.main')
@section('title')
    <title>Editar carrusel</title>
@endsection
@section('section')
<section class="container">
    <div class="row d-flex justify-content-center my-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p class="mb-0">Edite el contenido del carrusel</p>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.edited.carousel',$carousel->id)}}" enctype="multipart/form-data" id="idForm" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Título</label>
                            <div class="col-md-6">
                                <input id="title"  placeholder="Título" type="text" maxlength="100" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title',$carousel->title) }}" autocomplete="title" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>
                            <div class="col-md-6">
                                <textarea   style="min-height:100px; height:100px; max-height:300px;" name="description" maxlength="200" placeholder="Agrega una descripción a la imágen" id="description" class="form-control @error('description') is-invalid @enderror" autocomplete="description" autofocus >{{old('description',$carousel->description)}}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Imágen</label>
                            <div class="col-md-6">
                                <div class="custom-file">
                                    <input type="file" name="image" id="image" class="custom-file-input @error('image') is-invalid @enderror"  autofocus  accept="image/*" />
                                    <label for="image" class="custom-file-label" id="lblNameFile" >Selecciona una imágen</label>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                 @enderror
                                </div>
                            </div>
                        </div> 
                        <div class="form-group row mt-4  justify-content-center d-flex">                           
                            <div class="col-md-6 justify-content-center d-flex">
                               <input type="submit" disabled="true" id="btnForm" value="Agregar" class="btn btn-muk-cafe">
                            </div>
                        </div>
                    </form>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-5 col-12" id="preview"> <!-- Image preview -->
                            <img src="{{asset($carousel->image)}}" class="img-fluid" alt="{{$carousel->title}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 
@section('scripts')
    <script src="{{asset('js/form.js')}}"></script>
@endsection