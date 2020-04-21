@extends('layouts.main')
@section('title')
    <title>Usuarios</title>
@endsection
@section('section')
<section class="container">
    <div class="row my-4">
        <div class="col-12 my-4">
            <p class="text-center h4">Administre a sus usuarios</p>
            @if (Auth::user()->autorize(1))
                <div class="d-flex justify-content-center flex-wrap">
                    <a href="{{route('admin.create.user')}}" class="btn btn-primary">Nuevo Usuario</a>
                </div>
            @endif
        </div>
    </div>
    @if(session('info'))
        <div class="alert alert-success my-3 alert-dismissible fade show" role="alert">
            {{session('info')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <section class="row">
        <section class="col-12 mb-3">
            <p class="text-center h4">Usuarios registrados</p>
        </section>
        <section class="col-12">
            <table class="table table-sm table-striped table-hover table-borderless">
                <thead class="text-center">
                    <tr>                    
                        <th>Nombre</th>
                        <th class="hidden">Apellidos</th>
                        <th class="hidden">Email</th>
                        <th class="hidden">Tipo de usuario</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($users as $user)
                        @if (Auth::user()->id != $user->id)
                            <tr>
                                <td class="align-middle">{{$user->name}}</td>
                                <td class="hidden align-middle">{{$user->last_name}}</td>
                                <td class="hidden align-middle">{{$user->email}}</td>
                                <td class="hidden align-middle">{{$user->roles->role_name}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#more_{{$user->id}}">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        <span class="hidden">
                                            Más</span>
                                    </button>
                                    <div class="modal fade" id="more_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="more_{{$user->id}}Title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="more_{{$user->id}}Title">{{$user->name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Propiedad</th>
                                                                        <th>Valor</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Identificador</td>
                                                                        <td>{{$user->id}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Nombre</td>
                                                                        <td>{{$user->name}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Apellidos</td>
                                                                        <td>{{$user->surname}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Domicilio</td>
                                                                        <td>{{$user->address}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Código Postal</td>
                                                                        <td>{{$user->cp}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Teléfono</td>
                                                                        <td> {{$user->phone}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <td>Email</td>
                                                                    <td>{{$user->email}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tipo de usuario</td>
                                                                        <td>{{$user->roles->role_name}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    @if (Auth::user()->autorize(1))
                                        <button  class="btn  btn-danger" data-toggle="modal" data-target="#delete_{{$user->id}}"><i class="fa fa-trash" aria-hidden="true"></i>
                                            <span class="hidden">Eliminar</span></button>
                                        <div class="modal fade" id="delete_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="moreDelete{{$user->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="moreDelete{{$user->id}}">{{$user->name}} {{$user->surname}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Está seguro de que desea eliminar a este usuario?
                                                    <form action="{{route('admin.delete.user',$user->id)}}" id="product_{{$user->id}}" hidden method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                    <a href="javascript:document.getElementById('product_{{$user->id}}').submit()" class="btn btn-success">Sí, eliminar</a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        </section>
    </section>
</section>   
@endsection