<!doctype html>
<html class="wide wow-animation" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DelyApp</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/estilo.css')}}">

</head>
<body>
    <div id="head">
        <nav class="navbar navbar-expand-lg navbar-light color-nav">
            <a class="navbar-brand" href="#">
                <img src="{{URL::asset('/images/logo0.png')}}" width="120" height="50" class="d-inline-block align-top" alt="" loading="lazy">
            </a>

            <form class="form-inline d-flex justify-content-center md-form form-sm mt-0">
                <svg id="iconoBuscador" width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                </svg>
                <input class="form-control form-control-sm ml-3 w-150" id="buscador" type="text" placeholder="Buscador">
            </form>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                </ul>
                <button type="button" class="btn" id="botonIniciarSesion">
                    <svg id="iconoIniciarSesion" width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-person-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path fill-rule="evenodd" d="M2 15v-1c0-1 1-4 6-4s6 3 6 4v1H2zm6-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg>
                    INICIAR SESION
                </button>
                {{--<form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                <form class="form-inline d-flex justify-content-center md-form form-sm active-pink-2 mt-2">
                    <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Search"
                           aria-label="Search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </form>--}}
            </div>
        </nav>
        <main class="page-content">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{asset('js/core.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="https://checkout.culqi.com/js/v3"></script>
    @stack('scripts')
</body>
</html>
