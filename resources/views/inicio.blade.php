@extends('layouts.app')
@section('content')
<div class="cuerpo">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" id="imgCarrusel" src="{{URL::asset('/images/pub1.png')}}" alt="First slide" >
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" id="imgCarrusel" src="{{URL::asset('/images/pub3.jpg')}}" alt="Second slide" >
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" id="imgCarrusel" src="{{URL::asset('/images/pub5.jpg')}}" alt="Second slide" >
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" id="imgCarrusel" src="{{URL::asset('/images/pub4.jpg')}}" alt="Second slide" >
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" id="imgCarrusel" src="{{URL::asset('/images/pub2.jpg')}}" alt="Third slide" >
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
    <nav class="color-nav navBarraLocales">
        <p class="barraLocales">LOCALES</p>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12">&nbsp;</div>
            <div class="col-4 col-md-4 col-sm-12">
                <img class="d-block w-100 imgLocales" src="{{URL::asset('/images/pub4.jpg')}}" >
                <h4>NOMBRE DEL LOCAL</h4>
                <p>AQUI HAY DETALLE</p>
            </div>
            <div class="col-4 col-md-4 col-sm-12">
                <img class="d-block w-100 imgLocales" src="{{URL::asset('/images/pub1.png')}}" >
                <h4>NOMBRE DEL LOCAL</h4>
                <p>AQUI HAY DETALLE</p>
            </div>
            <div class="col-4 col-md-4 col-sm-12">
                <img class="d-block w-100 imgLocales" src="{{URL::asset('/images/pub5.jpg')}}" >
                <h4>NOMBRE DEL LOCAL</h4>
                <p>AQUI HAY DETALLE</p>
            </div>
            <div class="col-12">&nbsp;</div>
            <div class="col-4 col-md-4 col-sm-12">
                <img class="d-block w-100 imgLocales" src="{{URL::asset('/images/pub4.jpg')}}" >
                <h4>NOMBRE DEL LOCAL</h4>
                <p>AQUI HAY DETALLE</p>
            </div>
            <div class="col-4 col-md-4 col-sm-12">
                <img class="d-block w-100 imgLocales" src="{{URL::asset('/images/pub1.png')}}" >
                <h4>NOMBRE DEL LOCAL</h4>
                <p>AQUI HAY DETALLE</p>
            </div>
            <div class="col-4 col-md-4 col-sm-12">
                <img class="d-block w-100 imgLocales" src="{{URL::asset('/images/pub5.jpg')}}" >
                <h4>NOMBRE DEL LOCAL</h4>
                <p>AQUI HAY DETALLE</p>
            </div>
        </div>
    </div>
</div>
@endsection
