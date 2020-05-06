@extends('layouts.main')
@section('title')
    <title>Agregar usuario</title>
@endsection
@section('section')
<section class="container">
    <div class="row d-flex justify-content-center my-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <p class="mb-0">Agregar nuevo usuario</p>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.new.user')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                            <div class="col-md-6">
                                <input id="name"  placeholder="Nombre" minlength="1" type="text" maxlength="50" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Apellido</label>
                            <div class="col-md-6">
                                <input id="last_name"  placeholder="Ingrese su apellido" minlength="4" type="text" maxlength="50" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" autofocus>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Domicilio</label>
                            <div class="col-md-6">
                                <input id="address"  placeholder="Domicilio" minlength="4" type="text" maxlength="200" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cp" class="col-md-4 col-form-label text-md-right">Código postal</label>
                            <div class="col-md-6">
                                <input id="cp"  placeholder="Código postal" minlength="5" type="text" maxlength="5" class="form-control @error('cp') is-invalid @enderror" name="cp" value="{{ old('cp') }}" autocomplete="cp" autofocus>
                                @error('cp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Teléfono</label>
                            <div class="col-md-6">
                                <input id="phone"  placeholder="Número de teléfono" minlength="10" type="text" maxlength="10" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo electrónico</label>
                            <div class="col-md-6">
                                <input type="email" placeholder="example@example.com" name="email" value="{{old('email')}}" minlength="8" class="form-control @error('email') is-invalid @enderror" id="email"  autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="idRole" class="col-md-4 col-form-label text-md-right">Tipo de usuario</label>
                            <div class="col-md-6">                     
                                <select name="idRole"  id="idRole" class="custom-select @error('idRole') is-invalid @enderror"   autofocus autocomplete="idRole">
                                    <option disabled selected>Seleccione un rol</option>
                                   @foreach ($roles as $role)
                                       <option value="{{$role->id}}">{{$role->role_name}}</option>
                                   @endforeach
                                </select>
                                @error('idRole')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                            <div class="col-md-6">
                                <input type="password" placeholder="********" name="password" value="{{old('password')}}" minlength="8" class="form-control @error('password') is-invalid @enderror" id="password"  autocomplete="password" autofocus>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" placeholder="********" type="password" class="form-control" name="password_confirmation"  autocomplete="password">
                            </div>
                        </div>
                        <div class="form-group row mt-4  justify-content-center d-flex">                           
                            <div class="col-md-6 justify-content-center d-flex">
                               <input type="submit" value="Agregar" class="btn btn-muk-cafe">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection