<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @yield('title')
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" href="{{asset('css/animate.css')}}">
  <link rel="stylesheet" href="{{asset('css/imagehover.min.css')}}">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/logo/favicon.ico')}}">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  </head>
  <body>
    <header class="bg-light container-fluid ">
      <nav class="navbar navbar-expand-lg  bg-light navbar-light p-1">
        <a class="navbar-brand logo-button" href="{{ route('inicio')}}"><img class="img-fluid logo rounded-circle" src="{{asset('img/logoMukulum.jpg')}}"  alt=""> Café Mukulum</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex-lg justify-content-around" id="navbarNavDropdown">
          <ul class="navbar-nav">
            @guest
              <li class="nav-item ml-1 mr-1 mb-1">
                <!--<button class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#sesion">Inicia sesión</button>
                <div class="modal fade" id="sesion" tabindex="-1" role="dialog" aria-labelledby="sesion" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="sesion">Iniciar sesión</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="" method="POST">
                          @csrf
                          <div class="form-group">
                              <label for="email">Correo electrónico</label>
                              <input type="email" name="email" class="form-control" id="email" required>
                          </div>
                          <div class="form-group">
                              <label for="password">Contraseña</label>
                              <input type="password" name="password" class="form-control" id="password" required>
                          </div>
                          <div class="form-group d-flex justify-content-center">
                              <input type="submit" value="Aceptar" name="login" class=" mt-3 btn btn-success w-50 btn-block">
                          </div>
                      </form>
                      </div>
                      <div class="modal-footer"> 
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                      </div>
                    </div>
                  </div>
                </div>-->
                
                  <a class="btn btn-outline-success btn-block" href="{{ route('login') }}">Inicia sesión</a>
             
              </li>
              @if (Route::has('register'))
                <li class="nav-item ml-1 mr-1 mb-1">
                  <a class="btn btn-outline-secondary btn-light btn-block" href="{{route('register')}}">
                    Regístrate</a>
                </li>              
              @endif
              @else
               <!-- <li class="nav-item dropdown ml-1 mr-1 mb-1">
                  <a class=" btn-light btn-block btn dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user mr-2" aria-hidden="true"></i>Juan Hernández
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href=""><i class="fa fa-user mr-2" aria-hidden="true"></i>Mi perfil</a>
                    <a class="dropdown-item" href=""><i class="fa fa-sign-out mr-1" aria-hidden="true"></i>Cerrar sesión</a>
                    <a class="dropdown-item" href=""><i class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>Mis compras</a>
                    <a class="dropdown-item" href=""><i class="fa fa-lock mr-2" aria-hidden="true"></i>Panel de administración</a>
                  </div>
                </li>-->
                <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
            @endguest
            

          </ul>
        </div>
      </nav>
    </header>
    @yield('section')
    <footer class="container-fluid bg-light mt-5">
      <div class="row">
        <div class="col-12 mt-4">
          <p class="text-center font-weight-light font-weight-bold h4"> Síguenos en nuestras redes sociales!!</p>
           <p class="text-center">
             <a href="https://es-la.facebook.com/cafemukulum/" class="text-primary text-decoration-none mx-2 h2" title="Facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i>
            </a>
             <a href="#" class="text-danger text-decoration-none mx-2 h2" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i>
             </a>
             <a href="#" class="h2 text-primary text-decoration-none mx-2" title="Twitter"><i class="fa fa-twitter-square" aria-hidden="true"></i>
             </a>
           </p>
        </div>
      </div>
      <div class="row">

        <div class="col-md-6 col-12 order-md-1 order-2">
          <div class="container">
            <div class="row d-flex flex-column justify-conten-center">
                <p class="text-center h4 font-weight-light">Visión</p>
                <div class="col-12 text-justify font-weight-light">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.</p>
                </div>
                <p class="text-center h4 font-weight-light">Misión</p>
                <div class="col-12 text-justify font-weight-light">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.</p>
                </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 order-md-2 order-1">
            <div class="container">
              <div class="row">
                <div class="col-12 px-5">
                  <p class="h4 font-weight-light">Datos de contacto</p>
                  <p class="font-weight-light"><i class="fa fa-map-marker" aria-hidden="true"></i>
                   Av.centra No.32 entre 5 y 6 norte, Tuxtla Gutiérrez, Chiapas.</p>
                  <p class="font-weight-light"><i class="fa fa-phone" aria-hidden="true"></i> 4536789876
                  </p>
                  <p class="font-weight-light"><i class="fa fa-envelope-o" aria-hidden="true"></i> email@email.mx
                  </p>
                  <p class="font-weight-light"><i class="fa fa-whatsapp" aria-hidden="true"></i> 9876543432</p>
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 py-2 mb-2">
          <p class="text-center">©Copyright - Todos Derechos Reservados.</p>
        </div>
      </div>
    </footer>
    <script type="text/javascript" src="{{ asset('js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>
  </body>
</html>
