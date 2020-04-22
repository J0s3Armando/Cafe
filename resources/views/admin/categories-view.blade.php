@extends('layouts.main')
@section('title')
    <title>Categorías</title>
@endsection
@section('section')
    <section class="container">
        <div class="row my-4">
            <div class="col-12 my-4">
                <p class="text-center h4">Administre las categorías</p>
                @if (Auth::user()->autorize(1))
                    <div class="d-flex justify-content-center flex-wrap">
                       <form action="{{route('add.category')}}" id="formCategory" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="category" class="col-md-12 col-form-label text-md-center">Categoría</label>
                                <div class="col-md-12">
                                    <input id="category"  placeholder="Agregue nuevas categorías" minlength="3" type="text" maxlength="50" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}" autocomplete="category" autofocus>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-4  justify-content-center d-flex">                           
                                <div class="col-md-6 justify-content-center d-flex">
                                <input type="submit" value="Agregar" disabled="true" id="btnCategory" class="btn btn-success">
                                </div>
                            </div>
                       </form>
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
                <p class="text-center h4">Categorías registradas</p>
            </div>
            <div class="col-12">
                <table class="table table-sm table-striped table-hover table-borderless">
                    <thead class="text-center">
                        <tr>
                            <th>Id</th>
                            <th>Descripción</th>
                            <th>Fecha registro</th>
                            <th class="hidden">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($categories as $category)
                            <tr>
                                <td class="align-middle">{{$category->id}}</td>
                                <td class="align-middle">{{$category->category}}</td>
                                <td class="align-middle hidden">{{$category->created_at}}</td>
                                <td>
                                    <a href="{{route('admin.edit.category',$category->id)}}" class="btn btn-warning my-1"><i class="fa fa-pencil" aria-hidden="true"></i>
                                    <span class="hidden">Editar</span></a>
                                    @if (Auth::user()->autorize(1))
                                        <button  class="btn  btn-danger" data-toggle="modal" data-target="#delete_{{$category->id}}"><i class="fa fa-trash" aria-hidden="true"></i>
                                            <span class="hidden">Eliminar</span></button>
                                        <div class="modal fade" id="delete_{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="moreDelete{{$category->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="moreDelete{{$category->id}}">{{$category->category}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Está seguro de que desea eliminar esta categoría?
                                                    <form action="{{route('admin.delete.category',$category->id)}}" id="category_{{$category->id}}" hidden method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                    <a href="javascript:document.getElementById('category_{{$category->id}}').submit()" class="btn btn-success">Sí, eliminar</a>
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
        document.getElementById('formCategory').onchange=function(e)
        {
            document.getElementById('btnCategory').disabled=false;
        }
    </script>
@endsection