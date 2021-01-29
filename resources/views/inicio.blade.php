@extends('layouts.app')
@section('content')
<div class="cuerpo" id="contenedor">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="ml-3 mr-3"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="1000">

                <img class="d-block w-100" id="imgCarrusel" src="{{ asset('/images/banner1.jpeg') }}" alt="First slide" width="100%" height="200dp">
            </div>
            <div class="carousel-item" data-bs-interval="1000">
                <img class="d-block w-100" id="imgCarrusel" src="{{ asset('/images/banner2.jpeg') }}" alt="Second slide" width="100%" height="200dp">
            </div>
            <div class="carousel-item" data-bs-interval="1000">
                <img class="d-block w-100" id="imgCarrusel" src="{{ asset('/images/banner3.jpeg') }}" alt="Second slide" width="100%" height="200dp">
            </div>

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <nav class="navbar navbar-expand-md justify-content-center h4" style="background-color: #791313; ">
        <label class="justify-content-center text-white">LOCALES</label>
    </nav>
    @if(session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Perfecto: </strong> {{ session('mensaje') }}
          <button type="button" class="close" data-dismiss="alert" alert-label="Close">
            <span>&times;</span>
          </button>
        </div>
        @endif
    <div class="container-wide mt-5" id="containerLocales">
        <div class="row justify-content-xs-center mt-5 mb-5">

            @foreach($locales as $local)
            <div class="col-sm-6 col-md-4 view-animate zoomInSmall delay-04 active mt-5 text-center">
                <a class="thumbnail-variant-3" href="{{ route('local.index', $local['id']) }}">
                    <img type="button" src="{{ asset($local['imagen']) }}" width="300px" height="250px">
                </a>
                <h4>{{ $local['nombre'] }}</h4>
                <p class="mb-0 text-left" style="margin-left: 40px;">{{ $local['direccion']}}</p>
                <a class="float-left" style="margin-left: 40px;" href="tel: {{ $local['telefono'] }}">{{ $local['telefono'] }}</a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="mt-5 mb-5 col-12 text-center">
        {{ $locales->onEachSide(3)->links() }}
    </div>
</div>

<footer class="page-foot text-sm-left">
    <section class="bg-gray-darker section-top-55 section-bottom-60">
        <div class="container">
            <div class="row border-left-cell">
                <div class="col-sm-6 col-md-3 col-lg-4">
                    <a class="float-left  mr-5" href="{{ route('inicio') }}">
                        <img src="{{asset('/images/logo0.png')}}" width="120" height="50" class=".d-inline-block align-top" alt="Delyapp" loading="lazy">
                    </a>
                    <ul class="list-unstyled contact-info offset-top-5">
                        <li>
                            <div class="unit unit-horizontal unit-top unit-spacing-xxs">
                                <a href="{{ route('inicio.registrarLocal') }}" class="text-light"><u>Registra tu local</u></a>
                            </div>
                        </li>
                        <li>
                            <div class="unit unit-horizontal unit-top unit-spacing-xxs">
                                <a href="{{ route('inicio.contactateConNosotros') }}" class="text-light"><u>Contáctate con nosotros</u></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    $(document).ready(function() {
        $('#navbarSupportedContent').append(
            '<ul class="navbar-nav float-left">' +
            '<div class="nav-item form-inline">' +
            '<svg id="iconoBuscador" width="1.5em" height="1.5em" viewBox="0 0 16 16" class="ml-5" fill="white" xmlns="http://www.w3.org/2000/svg">' +
            '<path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />' +
            '<path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />' +
            '</svg>' +
            '<form class="nav-item form-inline text-left mt-0">' +
            '<input class="form-control form-control-md ml-1 w-100 text-white" style="background-color: #791313; border-color: #791313;" id="buscador" type="text" placeholder="Buscar local">' +
            '</form>' +
            '</div>' +
            '</ul>'
        )
    })

    $(document).on('keyup', '#buscador', function() {
        var texto = $(this).val();
        buscar(texto);
    });

    function buscar(texto) {
        $.ajax({
                url: 'buscador?texto=' + texto,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(respuesta) {
                document.getElementById('containerLocales').innerHTML = respuesta;
                //$('#containerLocales').html(respuesta);
            })
            .fail(function() {
                console.log("error");
            })
    }

    window.onload = function() {
        var pos = window.name || 0;
        window.scrollTo(0, pos);
    }
    window.onunload = function() {
        window.name = self.pageYOffset || (document.documentElement.scrollTop + document.body.scrollTop);
    }
</script>
@endsection