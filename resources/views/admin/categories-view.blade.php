@extends('layouts.main')
@section('title')
    <title>Categorías</title>
@endsection
@section('section')
    <section class="container">
        <div class="row my-4">
            <div class="col-12 my-4">
                <p class="text-center h4">Administre las categorías y subcategorías</p>                           
                    @if (Auth::user()->autorize(1)) 
                    <p class="text-center">
                        <button class="btn btn-muk-cafe-active m-1" type="button" data-toggle="collapse" data-target="#categoryCollapse" aria-expanded="false" aria-controls="categoryCollapse">Agregar categoría</button>
                        <button class="btn btn-muk-cafe-active m-1" type="button" data-toggle="collapse" data-target="#subCategoryCollapse" aria-expanded="false" aria-controls="subCategoryCollapse">Agregar subcategoría</button>
                    </p>
                    <div class="row">
                        <div class="col-12">
                          <div class="collapse" id="categoryCollapse">
                            <div class="card card-body">
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
                                        <div class="form-group">
                                            <label for="id_SubCategory" class="text-center">Seleccione una subcategoría</label>
                                             <select name="id_SubCategory" class="form-control" id="id_SubCategory">
                                                <option selected disabled>Opcional</option>
                                                @foreach ($subCategories as $subCategory)
                                                    <option value="{{$subCategory->id}}">{{$subCategory->description}}</option>
                                                @endforeach
                                             </select>
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
                        <div class="col">
                          <div class="collapse" id="subCategoryCollapse">
                            <div class="card card-body">
                                <div class="d-flex justify-content-center flex-wrap">
                                    <form action="{{route('admin.add.subcategory')}}" id="formSubCategory" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="description" class="col-md-12 col-form-label text-center">Subcategoría</label>
                                            <div class="col-md-12">
                                                <input id="description"  placeholder="Agregue nuevas subcategorías" minlength="3" type="text" maxlength="50" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description" autofocus>
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mt-4  justify-content-center d-flex">                           
                                            <div class="col-md-6 justify-content-center d-flex">
                                            <input type="submit" value="Agregar" disabled="true" id="btnSubCategory" class="btn btn-muk-cafe">
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
                <p class="text-center h4">Categorías</p>
            </div>
            <div class="col-12 table-responsive">
                @if (count($categories))
                    <table class="table table-sm table-striped table-hover table-borderless">
                        <thead class="text-center">
                            <tr>
                                <th>DESCRIPCIÓN</th>
                                <th>TIPO</th>
                                <th class="hidden">FECHA REGISTRO</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="align-middle">{{$category->category}}</td>
                                    @if ($category->id_SubCategory != null)
                                    <td class="align-middle">{{$category->Subcategory->description}}</td>
                                    @else
                                        <td class="align-middle">-----</td>
                                    @endif
                                    <td class="align-middle hidden">{{$category->created_at->format('d/m/Y H:i A')}}</td>
                                    <td>
                                        <a href="{{route('admin.edit.category',$category->id)}}" class="btn btn-muk-cafe my-1"><i class="fa fa-pencil" aria-hidden="true"></i>
                                        <span class="hidden">Editar</span></a>
                                        @if (Auth::user()->autorize(1))
                                            <button  class="btn  btn-outline-danger" data-toggle="modal" data-target="#delete_{{$category->id}}"><i class="fa fa-trash" aria-hidden="true"></i>
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
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                                        <a href="javascript:document.getElementById('category_{{$category->id}}').submit()" class="btn btn-danger">Sí, eliminar</a>
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
                @else
                    <h4 class="text-center">No hay categorías registradas.</h4>
                @endif
            </div>
        </div>
        <section class="row my-4">
            <div class="col-12 d-flex justify-content-center">
                {{$categories->render()}}
            </div>
        </section>
        <div class="row my-4">
            <div class="col-12 mb-3">
                <p class="text-center h4">Subcategorías</p>
            </div>
            <div class="col-12 table-responsive">
                @if (count($subCategories))
                    <table class="table table-sm table-striped table-hover table-borderless">
                        <thead class="text-center">
                            <tr>
                                <th>DESCRIPCIÓN</th>
                                <th class="hidden">FECHA REGISTRO</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($subCategories as $subCategory)
                                <tr>
                                    <td class="align-middle">{{$subCategory->description}}</td>
                                    <td class="align-middle hidden">{{$subCategory->created_at->format('d/m/Y H:i A')}}</td>
                                    <td>
                                        <a href="{{route('admin.edit.subCategory',$subCategory->id)}}" class="btn btn-muk-cafe my-1"><i class="fa fa-pencil" aria-hidden="true"></i>
                                        <span class="hidden">Editar</span></a>
                                        @if (Auth::user()->autorize(1))
                                            <button  class="btn  btn-outline-danger" data-toggle="modal" data-target="#deleteSub_{{$subCategory->id}}"><i class="fa fa-trash" aria-hidden="true"></i>
                                                <span class="hidden">Eliminar</span></button>
                                            <div class="modal fade" id="deleteSub_{{$subCategory->id}}" tabindex="-1" role="dialog" aria-labelledby="moreDeleteSub{{$subCategory->id}}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="moreDeleteSub{{$subCategory->id}}">{{$subCategory->description}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Está seguro de que desea eliminar esta subcategoría?
                                                        <form action="{{route('admin.delete.subCategory',$subCategory->id)}}" id="subCategory_{{$subCategory->id}}" hidden method="POST">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                                        <a href="javascript:document.getElementById('subCategory_{{$subCategory->id}}').submit()" class="btn btn-danger">Sí, eliminar</a>
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
                @else
                    <h4 class="text-center">No noy subcategorías registradas.</h4>
                @endif
            </div>
        </div>
        <section class="row my-4">
            <div class="col-12 d-flex justify-content-center">
                {{$subCategories->render()}}
            </div>
        </section>
    </section>
    <script>
        document.getElementById('formCategory').onchange=function(e)
        {
            document.getElementById('btnCategory').disabled=false;
        }
        document.getElementById('formSubCategory').onchange=function(e)
        {
            document.getElementById('btnSubCategory').disabled=false;
        }
    </script>
@endsection