@extends('layouts.app')
@section('content')

<div id="container">
  <section class="bg-image-5">
    <section class="parallax-container parallax-light" data-parallax-img="{{asset('images/home-slide-1-1920x800.jpg')}}">
      <div class="material-parallax parallax"><img src="{{asset('images/home-slide-1-1920x800.jpg')}}" alt=""></div>
      <div class="parallax-content">
        <div class="container section-80 section-sm-top-140 section-sm-bottom-150 text-center">
          <div class="row justify-content-xs-center">
            <div class="col-sm-10 col-lg-8">
              <h4 class="text-italic divider-custom-small-primary">Bienvenido/a</h4>
              <h2 class="text-uppercase text-italic offset-top-5 offset-sm-top-0">{{ $local->nombre }}</h2>
              <div class="unit unit-horizontal unit-middle unit-spacing-xs">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
  @if($promociones)
  <section class="section-50" style="background: #791313 !important">
    <h3 class="text-white text-center" style="text-align:center text-white">Nuestras promociones y combos</h3>
    <div class="container-wide mt-5">
      <div class="row justify-content-xs-center">

        @foreach($productos as $producto)
        @if($producto->categoria == 'promoción' || $producto->categoria == 'combo' && $producto->precio != 0)
        <div class="col-sm-6 col-md-4 view-animate zoomInSmall delay-04 active mt-5 text-center">
          <a class="thumbnail-variant-3" href="{{ route('carrito.producto', $producto) }}" onclick="enviar();">
            <img style="opacity: 0.6; max-width: 100%;" src="{{ asset($producto->imagen) }}" width="380" height="250">
            <div class="caption text-center">
              <h3 class="text-italic">{{ $producto->nombre }}</h3>
              <p class="big">{{ $producto->descripcion }}</p>
              <label class="h4 shadow" style="color: #f9b129">${{ number_format($producto->precio, 0, ",", ".") }}</label>
            </div>
          </a>
        </div>
        @endif
        @endforeach
      </div>
    </div>
  </section>
  @endif
  @if($menu)
  <section class="section-50 section-sm-top-80 section-sm-bottom-100">
    <h3 style="text-align:center">Nuestro Menú</h3>
    <div class="responsive-tabs responsive-tabs-button responsive-tabs-horizontal responsive-tabs-carousel offset-top-40" style="text-align:center">
      <ul class="resp-tabs-list">
        @foreach($categoria as $cat)
        @if ($cat->categoria != 'combo' && $cat->categoria != 'promoción')
        <li>{{ $cat -> categoria }}</li>
        @endif
        @endforeach
      </ul>

      <div class="resp-tabs-container text-center">
        @foreach($categoria as $cat)
        @if ($cat->categoria != 'combo' && $cat->categoria != 'promoción')
        <div>
          <!-- Slick Carousel-->
          <div class="slick-slider slick-tab-centered" data-arrows="true" data-loop="true" data-dots="false" data-swipe="true" data-items="1" data-xs-items="1" data-sm-items="2" data-md-items="3" data-lg-items="3" data-xl-items="5" data-center-mode="true" data-center-padding="10">

            @foreach($productos as $producto)
            @if ($cat->categoria == $producto->categoria && $producto->categoria != 'combo' && $producto->categoria != 'promoción' && $producto->precio != 0)
            <div class="item">
              <div class="thumbnail-menu-modern">
                <figure>
                  <img class="img" src="{{ asset($producto->imagen) }}" alt="No se ha cargado la imagen" width="310" height="260" />
                </figure>
                <div class="caption">
                  <h5 class="primary">{{ $producto->nombre }}</h5>
                  <p class="text-italic">{{ $producto->descripcion }}</p>
                  <p class="price">{{ number_format($producto->precio, 0, ",", ".") }}</p>
                  <a class="btn btn-shape-circle btn-burnt-sienna offset-top-15" href="{{ route('carrito.producto', $producto) }}" onclick="enviar();">
                    <span></span> Comprar
                  </a>
                </div>
              </div>
            </div>
            @endif
            @endforeach
          </div>
        </div>
        @endif
        @endforeach
      </div>
    </div>
    <div class="form-group row justify-content-center" style="display: flex; margin-top: 50px; margin-bottom: 200px; width: 100%;">
      <div id="map" style="height: 300px;"></div>
    </div>
  </section>
  @endif
  <footer class="page-foot text-sm-left">
    <section class="bg-gray-darker section-top-55 section-bottom-60">
      <div class="container">
        <div class="row border-left-cell">
          <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="float-left mr-5">
              <img src="{{ asset($local->logo) }}" width="120" height="50" class=".d-inline-block align-top" alt="{{ $local->nombre }}" loading="lazy">
            </div>
            <ul class="list-unstyled contact-info offset-top-5">
              <li>
                <div class="unit unit-horizontal unit-top unit-spacing-xxs">
                  <div class="unit-left"><span class="text-white">Dirección:</span></div>
                  <div class="unit-body text-left text-gray-light">
                    <p>{{ $local->direccion }}</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="unit unit-horizontal unit-top unit-spacing-xxs">
                  <div class="unit-left"><span class="text-white">Teléfono:</span></div>
                  <div class="unit-body"><a class="link-gray-light" href="tel: {{ $local->telefono }}">{{ $local->telefono }}</a></div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </footer>
</div>
<div class="text-center" id="spinner" style="margin-top: 300px" hidden>
  <div class="spinner-grow" style="width: 5rem; height: 5rem; color: #791313;" role="status">
    <span class="visually-hidden"></span>
  </div>
  <div class="spinner-grow" style="width: 5rem; height: 5rem; color: #f9b129;" role="status">
    <span class="visually-hidden"></span>
  </div>
  <div class="spinner-grow" style="width: 5rem; height: 5rem; color: #137830;" role="status">
    <span class="visually-hidden"></span>
  </div>
</div>

<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />

<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />

<script>
  var user_location = [ {{$local -> longitud}}, {{ $local -> latitud}} ];

  mapboxgl.accessToken = 'pk.eyJ1IjoiZ2Fib2J1ZG8iLCJhIjoiY2trNHM1enR4MW9kczJ4cGV6NHlrdTA1bSJ9.H8tB-u1v17oj7NclhK3iBA';
  var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: user_location,
    zoom: 14
  });

  var marker;

  function addMarker(ltlng) {

    marker = new mapboxgl.Marker({
        draggable: false,
        color: "#791313"
      })
      .setLngLat(user_location)
      .addTo(map);
  }

  map.on('load', function() {
    addMarker(user_location, 'load');
  });

  function enviar($producto) {
    $('#container').prop('hidden', true);
    $('#spinner').prop('hidden', false);

  }
</script>
@endsection