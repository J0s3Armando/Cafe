@extends('layouts.main')
@section('title')
  <title>Regístrate</title>
@endsection

@section('section')
    <section class="container mt-5">
        <div class="row my-5 d-flex justify-content-center">
            <div class="col-lg-10 col-12">
                <div class="card">            
                    <div class="card-header">
                        <h4>Regístrate</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group row mb-2">
                                <div class="col-md-6 col-12">
                                    <input type="text" name="name" required maxlength="30" minlength="3" class="form-control mb-2" id="name" placeholder="Nombres">
                                </div>
                                <div class="col-md-6 col-12">
                                    <input type="text" name="surname" required maxlength="30" minlength="5" class="form-control" id="surname" placeholder="Apellidos">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-md-6 col-12">
                                    <input type="text" maxlength="40" minlength="10" required name="address" class="form-control mb-2" id="address" required placeholder="Domicilio">
                                </div>
                                <div class="col-md-6 col-12">
                                    <input type="text" pattern="[0-9]*" maxlength="4" minlength="4" required name="postal" class="form-control" id="postal" placeholder="CP">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-md-6 col-12">
                                    <input type="email" maxlength="40" minlength="5" required name="email" class="form-control mb-2" id="email" placeholder="Correo electrónico">
                                </div>
                                <div class="col-md-6 col-12">
                                    <input type="password" maxlength="30" minlength="5" required name="postal" class="form-control" id="password" placeholder="Contraseña">
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <input type="submit" value="Registrarse" name="submit" class="btn btn-outline-success">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="mb-0">Por favor llena todos los campos.</p>
                    </div>       
                </div>
               
            </div>
        </div>
    </section>
@endsection