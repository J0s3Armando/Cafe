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
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/logo/favicon.ico')}}">
  <link href="https://fonts.googleapis.com/css?family=Orbitron:400,700&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css?family=Didact+Gothic&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  </head>
  <body>
    <header class="container-fluid ">
      <nav class="navbar navbar-expand-lg navbar-dark p-1">
          <a class="navbar-brand logo-button d-flex align-items-center" href="{{ route('index')}}">
            <img class="img-fluid logo bg-white float-left rounded-circle"
          src="{{asset('img/logo/thumbnail_café mukulum-01.png')}}" style="height:45px;"  alt="café mukulum">
          <div>
            <p class="mb-0">
              CAFÉ<span class="font-weight-bold mb-0 ">MUKULUM</span>
              <br class="mb-0">
              <span class="sub">Los mejores granos de la región tzeltal</span>
            </p>
            </div> 
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" 
          data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse d-flex-lg justify-content-around" id="navbarNavDropdown">
            <ul class="navbar-nav">
              @guest
                <li class="nav-item ml-1 mr-1 mb-1">
                    <a class="btn muk-light btn-block" href="{{ route('login') }}">Inicia sesión</a>
                </li>
                @if (Route::has('register'))
                  <li class="nav-item ml-1 mr-1 mb-1">
                    <a class="btn muk-active btn-block" href="{{route('register')}}">
                      Regístrate</a>
                  </li>              
                @endif
                @else
                  <li>
                    <a class="btn btn-block muk-light" href="{{route('profile')}}" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                      <i class="fa fa-user mr-2" aria-hidden="true"></i>{{ Auth::user()->name }} <span class="caret"></span>
                   </a>
                  </li>
                   <a class="btn muk-light" href="{{route('cart')}}">
                    <i class="fa fa-cart-arrow-down mr-2" aria-hidden="true"></i>Carrito</a>
                  <li>
                    <li>
                      <a class="btn btn-block muk-light" href="{{route('orders')}}"><i class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>Mis pedidos</a>
                    </li>
                  </li>
                  @if(Auth::user()->autorize([1,3]))
                    <li>
                      <a class="btn btn-block muk-light" href="{{route('panel.admin')}}"><i class="fa fa-lock mr-2" aria-hidden="true"></i>Panel de administración</a>
                    </li>
                  @endif
                  <li>
                    <a class="btn muk-light btn-block" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="fa fa-sign-out mr-1" aria-hidden="true"></i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </li>
              @endguest
              <li class="nav-item ml-1 mr-1 mb-1">
                <a class="btn muk-light btn-block" href="{{route('aboutUs')}}">Nosotros</a>
              </li>
            </ul>
          </div>
      </nav>
    </header>
    @yield('section')
    <footer class="container-fluid bg-light mt-5">
      <div class="row">
        <div class="col-12 mt-4">
          <p class="text-center font-weight-bold h4"> Síguenos en nuestras redes sociales!!</p>
           <p class="text-center">
             <a href="https://es-la.facebook.com/cafemukulum/" class="text-white text-decoration-none mx-2 h2" title="Facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i>
            </a>
             <a href="#" class="text-white text-decoration-none mx-2 h2" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i>
             </a>
             <a href="#" class="h2 text-white text-decoration-none mx-2" title="Twitter"><i class="fa fa-twitter-square" aria-hidden="true"></i>
             </a>
           </p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-lg-9 col-12 order-md-1 order-2">
          <div class="container">
            <div class="row">
                <div class="col-12">
                  <h4 class="text-center">Locales</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="row">
                      <div class="col-12">
                        <h5 class="text-center">Tuxtla Gutiérrez</h5>
                      </div>
                      <div class="col-md-12 col-lg-6 col-sm-12">
                        <h6 class="font-weight-bold text-center">Amor A Chiapas, Bazar</h5>
                          <hr class="bg-light">
                        <p class="font-weight-light"><i class="fa fa-map-marker" aria-hidden="true"></i>
                        Av.centra No.32 entre 5 y 6 norte, Tuxtla Gutiérrez, Chiapas.</p>
                      </div>
                      <div class="col-md-12 col-lg-6 col-sm-12">
                        <h6 class="font-weight-bold text-center">Hotel Hilton Garden Inn</h6>
                        <hr class="bg-light">
                        <p class="font-weight-light"><i class="fa fa-map-marker" aria-hidden="true"></i>
                        Av.centra No.32 entre 5 y 6 norte, Tuxtla Gutiérrez, Chiapas.</p>
                        <p class="font-weight-light"><i class="fa fa-phone" aria-hidden="true"></i> 4536789876
                        </p>
                      </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                  <h5 class="text-center">Sancristobal De Las Casas</h5>
                  <h6 class="font-weight-bold text-center">Marchante, Mercadito Culinario</h6>
                  <hr class="bg-light">
                  <p class="font-weight-light"><i class="fa fa-map-marker" aria-hidden="true"></i>
                    Av.centra No.32 entre 5 y 6 norte, Tuxtla Gutiérrez, Chiapas.</p>
                </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-lg-3 order-md-2 order-1">
            <div class="container">
              <div class="row">
                <div class="col-12 px-5">
                  <p class="h4 font-weight-light">Datos de contacto</p>
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
      <section class="row py-3">
        <div class="col-12">
          <h4 class="text-center">¡Gracias por visitarnos!</h4>
        </div>
      </section>
    </footer>
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  </body>
</html>
