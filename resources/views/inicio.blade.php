@extends('layouts.app')
@section('content')
<div class="cuerpo">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="local/1">
                    <img class="d-block w-100" id="imgCarrusel" src="https://dcrk.cl/web2018/wp-content/uploads/2018/03/bajada_comidarapida.jpg" alt="First slide" width="100%" height="400px">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" id="imgCarrusel" src="https://media-cdn.tripadvisor.com/media/photo-s/11/a4/05/c1/local.jpg" alt="Second slide" width="100%" height="400px">
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
    <div class="container-wide mt-5">
        <div class="row justify-content-xs-center mt-5 mb-5">

            @foreach($locales as $local)
            <div class="col-sm-6 col-md-4 view-animate zoomInSmall delay-04 active mt-5 text-center">
                <a class="thumbnail-variant-3" href="local/1">
                    <img type="button" src="https://dcrk.cl/web2018/wp-content/uploads/2018/03/bajada_comidarapida.jpg" width="300px" height="250px">
                </a>
                <h4>{{ $local->nombre }}</h4>
                <p class="mb-0 text-left" style="margin-left: 40px;">{{ $local->direccion }}</p>
                <a class="float-left" style="margin-left: 40px;" href="tel: {{ $local->telefono }}">{{ $local->telefono }}</a>
            </div>
            @endforeach

        </div>
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
                                <div class="unit-left"><span class="text-white">Dirección:</span></div>
                                <div class="unit-body text-left text-gray-light">
                                    <p>direccion</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="unit unit-horizontal unit-top unit-spacing-xxs">
                                <div class="unit-left"><span class="text-white">Teléfono:</span></div>
                                <div class="unit-body"><a class="link-gray-light" href="#">telefono</a></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</footer>

@endsection