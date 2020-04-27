@extends('layouts.main')
@section('title')
    <title>Unidad - {{$unit->description}}</title>
@endsection
@section('section')
<section class="container">
    <div class="row my-4">
        <div class="col">
            <div class="col-12 mb-3">
                <p class="text-center h4">Edite la unidad</p>
            </div>
        </div>
    </div>
    <div class="row my-4 d-flex justify-content-center">
        <div class="col-lg-6 col-md-10">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.edited.unit',$unit->id)}}" id="formUnit" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="description" class="col-md-12 col-form-label text-md-center">Descripción</label>
                            <div class="col-md-12">
                                <input id="description"  placeholder="Agregue nuevas unidades"
                                minlength="3" type="text" maxlength="50" class="form-control @error('description') is-invalid @enderror"
                                name="description" value="{{ old('description',$unit->description) }}" autocomplete="description" autofocus>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-4  justify-content-center d-flex">                           
                            <div class="col-md-6 justify-content-center d-flex">
                            <input type="submit" value="Agregar" disabled="true" id="btnUnit" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.getElementById('formUnit').onchange=function(e)
    {
        document.getElementById('btnUnit').disabled=false;
    }
</script>
@endsection