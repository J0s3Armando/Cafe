@extends('layouts.main')
@section('title')
    <title>Editar producto</title>
@endsection
@section('section')
    <section class="container">
        <div class="row d-flex justify-content-center my-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <p class="mb-0">Editar producto producto</p>
                    </div>
                    <div class="card-body">
                        <form id="updateProduct" action="{{route('admin.editProduct',$product->id)}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Producto</label>
                                <div class="col-md-6">
                                    <input id="description" required placeholder="Nombre del producto" minlength="4" type="text" maxlength="40" class="form-control @error('description') is-invalid @enderror" name="description" value="{{old('description',$product->description )}}" autocomplete="description" autofocus>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="code" class="col-md-4 col-form-label text-md-right">Código</label>
                                <div class="col-md-6">
                                    <input id="code" required placeholder="ejemplo XKDT01" minlength="4" type="text" maxlength="40" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code',$product->code) }}" autocomplete="code" autofocus>
                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">Precio</label>
                                <div class="col-md-6">
                                    <input type="number" placeholder="00.00" min="1" name="price" id="price" step=".10" class="form-control @error('price') is-invalid @enderror" value="{{old('price',$product->price)}}" required autocomplete="price">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="stock" class="col-md-4 col-form-label text-md-right">Existencias</label>
                                <div class="col-md-6">
                                    <input type="number" placeholder="00" min="1" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{old('stock',$product->stock)}}" required autocomplete="stock">
                                    @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="long_description" class="col-md-4 col-form-label text-md-right">Descripción</label>
                                <div class="col-md-6">
                                    <textarea required  style="min-height:100px; height:100px; max-height:300px;" name="long_description" minlength="fa-rotate-180" placeholder="Agrega una descripción al producto para tus clientes" id="long_description" class="form-control @error('long_description') is-invalid @enderror" autocomplete="long_description" autofocus >{{old('long_description',$product->long_description)}}</textarea>
                                    @error('long_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category" class="col-md-4 col-form-label text-md-right">Categoría</label>
                                <div class="col-md-6">                     
                                    <select name="id_categories"  id="category" class="custom-select @error('id_categories') is-invalid @enderror" required  autofocus autocomplete="category">
                                       @foreach ($categories as $category)
                                            @if ($category->id == $product->id_categories)
                                                 <option value="{{$category->id}}">{{$category->category}}</option>
                                            @else
                                                <option value="{{$category->id}}">{{$category->category}}</option>
                                            @endif       
                                       @endforeach
                                    </select>
                                    @error('id_categories')
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
                                        <input type="file" name="image" id="image" class="custom-file-input @error('image') is-invalid @enderror" autofocus  accept="image/*" />
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
                                   <input disabled type="submit" id="btnUpdate" value="Actualizar" class="btn btn-success">
                                </div>
                            </div>
                        </form>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-5 col-10" id="preview"> <!-- Image preview -->
                                <img src="{{asset($product->image)}}" alt="{{$product->description}}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('image').onchange=function(e){
  var files = e.target.files;
  var type = files[0].type;
  var preview = document.getElementById('preview');
  var lblNameFile = document.getElementById('lblNameFile');
  lblNameFile.innerHTML=files[0].name;
  preview.innerHTML='';
  if(type.match("image/*"))
  {    
      var reader = new FileReader();
      reader.readAsDataURL(e.target.files[0]);
      reader.onload=function()
      {
          var image = document.createElement('img');
          image.classList="img-fluid w-100";
          image.src=reader.result;
          preview.appendChild(image);
      };              
  }
  else{
      var messageAlert = document.createElement('div');
      messageAlert.classList = "alert alert-danger";
      var message = "El archivo seleccionado no cuenta con el formato requerido";
      messageAlert.innerHTML=message;
      preview.appendChild(messageAlert);
  }
}

document.getElementById('updateProduct').onchange = function(){
document.getElementById('btnUpdate').disabled=false;
};
    </script>
@endsection