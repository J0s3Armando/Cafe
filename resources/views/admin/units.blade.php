@extends('layouts.main')
@section('title')
    <title>Unidades</title>
@endsection
@section('section')
   <section class="container">
    <div class="row my-4">
        <div class="col-12 my-4">
            <p class="text-center h4">Administre las unidades de los productos</p>                           
                @if (Auth::user()->autorize(1)) 
                <p class="text-center">
                    <button class="btn btn-primary m-1" type="button" data-toggle="collapse" data-target="#unitCollapse" aria-expanded="false" aria-controls="unitCollapse">Agregar Unidades</button>
                </p>
                <div class="row">
                    <div class="col-12">
                      <div class="collapse" id="unitCollapse">
                        <div class="card card-body">
                            <div class="d-flex justify-content-center flex-wrap">
                                <form action="{{route('admin.add.unit')}}" id="formUnit" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="description" class="col-md-12 col-form-label text-md-center">Descripción</label>
                                        <div class="col-md-12">
                                            <input id="description"  placeholder="Agregue nuevas unidades"
                                            minlength="3" type="text" maxlength="50" class="form-control @error('description') is-invalid @enderror" 
                                            name="description" value="{{ old('description') }}" autocomplete="description" autofocus>
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
                </div>
                @endif
        </div>
    </div>
    @if(session('info'))
        <div class="alert alert-success mt-3 mb-0 alert-dismissible fade show" role="alert">
            {{session('info')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row my-4">
        <div class="col-12 mb-3">
            <p class="text-center h4">Unidades registradas</p>
        </div>
        <div class="col-12">
            <table class="table table-sm table-striped table-hover table-borderless">
                <thead class="text-center">
                    <tr>
                        <th>Id</th>
                        <th>Descripción</th>
                        <th class="hidden">Fecha de registro</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($units as $unit)
                        <tr>
                            <td class="align-middle">{{$unit->id}}</td>
                            <td class="align-middle">{{$unit->description}}</td>
                            <td class="align-middle hidden">{{$unit->created_at}}</td>
                            <td>
                                <a href="{{route('admin.edit.unit',$unit->id)}}" class="btn btn-warning my-1"><i class="fa fa-pencil" aria-hidden="true"></i>
                                <span class="hidden">Editar</span></a>
                                @if (Auth::user()->autorize(1))
                                    <button  class="btn  btn-danger" data-toggle="modal" data-target="#deleteUnit_{{$unit->id}}"><i class="fa fa-trash" aria-hidden="true"></i>
                                        <span class="hidden">Eliminar</span></button>
                                    <div class="modal fade" id="deleteUnit_{{$unit->id}}" tabindex="-1" role="dialog" aria-labelledby="moreDeleteUnit{{$unit->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="moreDeleteUnit{{$unit->id}}">{{$unit->description}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro de que desea eliminar esta unidad?
                                                <form action="{{route('admin.delete.unit',$unit->id)}}" id="unit_{{$unit->id}}" hidden method="POST">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                <a href="javascript:document.getElementById('unit_{{$unit->id}}').submit()" class="btn btn-success">Sí, eliminar</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>     
                    @endforeach
                </tbody>
            </table>
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