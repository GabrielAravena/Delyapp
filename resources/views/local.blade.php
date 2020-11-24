@extends('layouts.app')
@section('content')

<section class="bg-image-5">
  <section class="parallax-container parallax-light" data-parallax-img="{{asset('images/parallax-03.png')}}">
    <div class="material-parallax parallax"><img src="{{asset('images/parallax-03.png')}}" alt="" style="display: block;"></div>
    <div class="parallax-content">
      <div class="container section-80 section-sm-top-140 section-sm-bottom-150 text-center">
        <div class="row justify-content-xs-center">
          <div class="col-sm-10 col-lg-8">
            <h4 class="text-italic divider-custom-small-primary">Bienvenido</h4>
            <h2 class="text-uppercase text-italic offset-top-5 offset-sm-top-0">{{ $local->nombre }}</h2>
            <div class="unit unit-horizontal unit-middle unit-spacing-xs">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</section>
<section class="section-50 section-sm-top-80 section-sm-bottom-100 bg-gray-lighter">
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
      <div>
        <!-- Slick Carousel-->
        <div class="slick-slider slick-tab-centered" data-arrows="true" data-loop="true" data-dots="false" data-swipe="true" data-items="1" data-xs-items="1" data-sm-items="2" data-md-items="3" data-lg-items="3" data-xl-items="5" data-center-mode="true" data-center-padding="10">

          @foreach($productos as $producto)
          @if ($cat->categoria == $producto->categoria && $producto->categoria != 'combo' && $producto->categoria != 'promoción')
          <div class="item">
            <div class="thumbnail-menu-modern">
              <figure>
                <img class="img" src="https://sevilla.abc.es/gurme/wp-content/uploads/sites/24/2013/04/pizza-margarita-960x540.jpg" alt="" width="310" height="260" />
              </figure>
              <div class="caption">
                <h5 class="primary">{{ $producto->nombre }}</h5>
                <p class="text-italic">{{ $producto->descripcion }}</p>
                <p class="price">{{ number_format($producto->precio, 0, ",", ".") }}</p>
                <a class="btn btn-shape-circle btn-burnt-sienna offset-top-15" href="{{ route('carrito.producto', $producto) }}" style="padding: 5px 20px !important;">
                  <span style="font-size: 23px !important;"></span> Comprar
                </a>
              </div>
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section class="section-50" style="background: #791313 !important">
  <h3 class="text-white text-center" style="text-align:center text-white">Nuestras promociones y combos</h3>
  <div class="container-wide mt-5">
    <div class="row justify-content-xs-center">

      @foreach($productos as $producto)
      @if($producto->categoria == 'promoción' || $producto->categoria == 'combo')
      <div class="col-sm-6 col-md-4 view-animate zoomInSmall delay-04 active mt-5">
        <a class="thumbnail-variant-3" href="{{ route('carrito.producto', $producto) }}">
          <img class="img-responsive" style="opacity: 0.6;" src="https://static.iris.net.co/dinero/upload/images/2016/12/15/240194_1.jpg" alt="" width="566" height="401">
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
<footer class="page-foot text-sm-left">
  <section class="bg-gray-darker section-top-55 section-bottom-60">
    <div class="container">
      <div class="row border-left-cell">
        <div class="col-sm-6 col-md-3 col-lg-4">
          <a class="float-left  mr-5" href="#">
            <img src="{{asset('/images/logo0.png')}}" width="120" height="50" class=".d-inline-block align-top" alt="Delyapp" loading="lazy">
          </a>
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
@endsection