<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DelyApp</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('js/bootstrap-fileinput/css/fileinput.min.css')}}" type="text/css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .navbar-expand-md .nav .nav-item .nav-link:hover {
            background-color: #530705;
        }

        .btn-green {
            color: #fff;
            background-color: #137830;
        }

        .btn-green:hover {
            color: #fff;
            background-color: #095603;
        }

        ::placeholder {
            color: #9d9d9d;
        }

        #telefono::placeholder {
            color: #9d9d9d;
        }

    </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="fixed-left navbar-expand-md shadow-lg" style="background-color: #791313;">
                <button class="navbar-toggler ml-3 mt-3" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-list-ul" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                    </svg>
                </button>
                <div class="navbar-expand-md d-md-block collapse col-md-3 col-lg-2" id="sidebarMenu">
                    <ul class="nav flex-column text-left">
                        <li class="nav-item" width="170" height="70" style="padding-top: 40px;">
                            <img src="{{asset('/images/logo0.png')}}" width="170" height="70" class=".d-inline-block align-top" alt="Delyapp" loading="lazy">
                        </li>
                        <div class="mt-3 justify-content-center form-inline">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-gear" viewBox="0 0 16 16">
                                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                            </svg>
                            <a href="{{ route('configuracion.index') }}" class="ml-1 text-white" onclick="activarSpinner();">Configuración</a>
                        </div>

                        <li class="nav-item" style="padding-top: 20px;">
                            <a class="nav-link h5 text-white" href="{{ route('inicioAdmin.index') }}" onclick="activarSpinner();">
                                Inicio
                            </a>
                        </li>
                        <li class="nav-item pt-3">
                            <a class="nav-link h5 text-white" href="{{ route('pedidos.index') }}" onclick="activarSpinner();">
                                Pedidos
                            </a>
                        </li>
                        <li class="nav-item pt-3">
                            <a class="nav-link h5 text-white" href="{{ route('inventario.index') }}" onclick="activarSpinner();">
                                Inventario
                            </a>
                        </li>
                        <li class="nav-item pt-3">
                            <a class="nav-link h5 text-white" href="{{ route('menu.index') }}" onclick="activarSpinner();">
                                Menú
                            </a>
                        </li>
                        <li class="nav-item pt-3">
                            <a class="nav-link h5 text-white" href="{{ route('ventas.index') }}" onclick="activarSpinner();">
                                Ventas
                            </a>
                        </li>

                        <li class="nav-item" style="padding-top: 30px; padding-bottom: 25px;">
                            <form method="get" action="{{ route('vender.index') }}">
                                <button class="btn btn-primary" style="width: 170px; height: 100px;" onclick="activarSpinner();">
                                    Vender
                                </button>
                            </form>
                        </li>

                        @guest
                        <li class="nav-item">
                            <a class="text-white text-center" role="button" href="{{ route('login') }}">
                                <svg id="iconoIniciarSesion" width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-square mr-1" fill="white" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path fill-rule="evenodd" d="M2 15v-1c0-1 1-4 6-4s6 3 6 4v1H2zm6-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                                Iniciar sesión
                            </a>
                        </li>
                        @else
                        <li class="dropdown" style="padding-bottom: 70px;">
                            <div id="navbarDropdown" class="dropdown-toggle text-white text-center" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <svg id="iconoIniciarSesion" width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-square mr-1" fill="white" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                    <path fill-rule="evenodd" d="M2 15v-1c0-1 1-4 6-4s6 3 6 4v1H2zm6-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                                {{ Auth::user()->name }}
                            </div>

                            <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>
                                <div class="mt-3 justify-content-center form-inline">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                                    </svg>
                                    <a href="{{ route('configuracion.indexAdmin') }}" class="ml-1" style="color: black;">Administrador</a>
                                </div>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-3">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="{{asset('js/core.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="https://checkout.culqi.com/js/v3"></script>
    <script src="{{asset('js/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap-fileinput/themes/fas/theme.min.js')}}" type="text/javascript"></script>

    <script>

    function activarSpinner(){
        $('#container').prop('hidden', true);
        $('#spinner').prop('hidden', false);
    }
    </script>

</html>