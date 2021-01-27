@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <!-- Header -->
      <div class="header mt-md-5 mb-3">
        <div class="header-body">
          <div class="row align-items-center">
            <div class="col">

              <!-- Title -->
              <h3 class="header-title">
                Carrito de compras
              </h3>
              @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                  <span>&times;</span>
                </button>
              </div>
              @endif
            </div>
          </div> <!-- / .row -->
        </div>
      </div>
      <div class="card mb-5">
        @if($productos)
        <div class="mt-3 text-center">
          <label class="h5">
            <strong>
              Estás comprando en {{ $local->nombre }}
            </strong>
          </label>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="card justify-content-center text-center">
                <table class="table table-sm">
                  <thead>
                    <tr class="text-center">
                      <th class="text-center" scope="col">Producto</th>
                      <th class="text-center" scope="col">Cantidad</th>
                      <th class="text-right" scope="col">Precio unitario</th>
                      <th class="text-right" scope="col">Total</th>
                      <th class="text-center" scope="col">Eliminar</th>
                    </tr>
                  </thead>
                  <tbody id="tablaProductos">
                    @foreach($productos as $producto)
                    <tr >
                      <td>{{ $producto->nombre }}</td>
                      <td>{{ $producto->cantidad }}</td>
                      <td style="text-align:right">{{ number_format($producto->precio, 0, ",", ".") }}</td>
                      <td style="text-align:right">{{ number_format($producto->precio * $producto->cantidad, 0, ",", ".") }}</td>
                      <td style="text-align:center">
                        <a href="{{ route('carrito.delete', $producto->id) }}">
                          <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="red" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                          </svg>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                    @if($productos[0]->delivery)
                    <tr >
                      <td>Delivery</td>
                      <td>1</td>
                      <td style="text-align:right">{{ number_format($local->valor_delivery, 0, ",", ".") }}</td>
                      <td style="text-align:right">{{ number_format($local->valor_delivery, 0, ",", ".") }}</td>
                      <td style="text-align:center"></td>
                    </tr>
                    @endif
                    <input id="deliveryExist" name="delivery" type="text" value="{{ $productos[0]->delivery }}" hidden>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="form-inline row justify-content-center mt-5" style="text-align:right;">
            <label class="h6 mr-3" style="text-align:right;">Precio total</label>
            <label class="h5" style="text-align:right;"><strong></strong>${{ number_format($producto->total, 0, ",", ".") }}</label>
          </div>
          @if($local->delivery)
          <div class="form-inline row justify-content-center mt-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
            </svg>
            <label class="ml-3">
              <strong>
                Este local cuenta con delivery
              </strong>
            </label>
          </div>

          <div class="form-inline row justify-content-center mt-3">
            <label>Soliciar delivery (+ ${{ number_format($local->valor_delivery, 0, ",", ".") }})</label>
            <input class="ml-3" id="delivery" type="checkbox" name="delivery">
            <div class="text-center ml-3" id="spinner" hidden>
              <div class="spinner-grow" style="width: 1rem; height: 1rem; color: #791313;" role="status">
                  <span class="visually-hidden"></span>
              </div>
              <div class="spinner-grow" style="width: 1rem; height: 1rem; color: #f9b129;" role="status">
                  <span class="visually-hidden"></span>
              </div>
              <div class="spinner-grow" style="width: 1rem; height: 1rem; color: #137830;" role="status">
                  <span class="visually-hidden"></span>
              </div>
          </div>
          </div>
          @else
          <div class="form-inline row justify-content-center mt-3" style="text-align:right;">
            <label>
              <strong>Este local no cuenta con delivery</strong>
            </label>
          </div>
          @endif
          @guest
          <div class="mt-5" style="margin-bottom: 100px">
            <div class="form-group offset-md-2">
              <label class="col-md-3">
                <input id="sugerido" name="radio" type="radio" value="sugerido" checked onclick="iniciar();" />
                <span>Iniciar sesión</span>
              </label>
            </div>
            <div class="mt-5" id="iniciar_sesion">
              <form method="POST" action="{{ route('carrito.login') }}">
                @csrf
                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                  <div class="col-md-6">
                    <input id="email_inicio" type="email" class="form-control col-form-label @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email" >

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>Este correo no está registrado</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                  <div class="col-md-6">
                    <input id="password" type="password" class="form-control col-form-label @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>La contraseña es incorrecta</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row mb-5 mt-5">
                  <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-green">
                      Ingresar
                    </button>
                    <a class="btn btn-primary text-white" href="{{ route('local.index', $producto->local_id) }}">
                      Seguir comprando
                    </a>
                  </div>
                </div>
              </form>
            </div>
            <div class="form-group row offset-md-2">
              <label class="col-md-3">
                <input id="otro" name="radio" type="radio" value="otro" onclick="invitado();" />
                <span>Comprar como invitado</span>
              </label>
            </div>
            <div class="mt-5" id="comprar_invitado" style="display: none;">
              <form method="POST" action="{{ route('carrito.pagar') }}" id="form_invitado">
                @csrf
                <input type="hidden" name="token_ws" value="{{ $token_ws }}">
                <input type="hidden" name="url" value="{{ $url }}">
                <input type="hidden" name="local_id" value="{{ $local->id }}">

                <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                  <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                  <div class="col-md-6">
                    <input id="email_invitado" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="telefono" class="col-md-4 col-form-label text-md-right">Teléfono</label>

                  <div class="col-md-6">
                    <input id="telefono" type="tel" class="form-control" name="telefono" placeholder="Ejemplo: 912345678" pattern="[0-9]{9}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="direccion" class="col-md-4 col-form-label text-md-right">Dirección</label>
                  <div class="col-md-6">
                    <div class="geocoder">
                      <div id="geocoder"></div>
                    </div>
                  </div>
                </div>
                
                <div class="form-group row justify-content-center" style="display: flex;">
                    <div class="col-md-4">
                        <div id="map" style="height: 150px;"></div>
                    </div>
                </div>

                <input name="delivery" type="text" value="{{ $productos[0]->delivery }}" hidden>

                <input type="text" id="direccion" name="direccion" hidden required>
                <input type="text" id="latitud" name="latitud" hidden>
                <input type="text" id="longitud" name="longitud" hidden>

                <div class="form-group row mb-5" style="margin-top: 180px;">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-green">
                      Pagar
                    </button>
                    <a class="btn btn-primary text-white" href="{{ route('local.index', $producto->local_id) }}">
                      Seguir comprando
                    </a>
                  </div>
                </div>
              </form>
            </div>
          </div>
          @else
          <form method="POST" action="{{ route('carrito.pagar') }}">
            @csrf
            <input type="hidden" name="token_ws" value="{{ $token_ws }}">
            <input type="hidden" name="url" value="{{ $url }}">
            <input type="hidden" name="local_id" value="{{ $local->id }}">
            <input name="delivery" type="hidden" value="{{ $productos[0]->delivery }}">
            <div class="form-group row mb-5 mt-5">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-green">
                  Pagar
                </button>
                <a class="btn btn-primary text-white" href="{{ route('local.index', $producto->local_id) }}">
                  Seguir comprando
                </a>
              </div>
            </div>
          </form>
          @endguest
        </div>
      </div>

      @else
      <h4 class="mt-5 mb-5 ml-5">Oops... Tu carrito está vacío.</h4>
      <a href="{{ route('inicio') }}" class="btn btn-primary mt-5 mb-5">volver</a>
      @endif
    </div>
  </div>

  <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
  <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />

  <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
  <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />

  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>


  <script>

    $(document).ready(function(){

      var delivery = $('#deliveryExist').val();
   
      if(delivery == 1){
        $('#delivery').prop('checked', true);
      }

      $('#delivery').on('click', function(event){

        $('#spinner').prop('hidden', false);
        
        if(delivery == 1){
          window.location = "{{ route('carrito.quitarDelivery') }}";
        }else{
          window.location = "{{ route('carrito.agregarDelivery') }}";
        }
      });
    });
  
    function iniciar() {
      document.getElementById('iniciar_sesion').style.display = 'block';
      document.getElementById('comprar_invitado').style.display = 'none';
      $('#email_inicio').prop("required", true);
      $('#password').prop("required", true);
    }

    function invitado() {
      document.getElementById('comprar_invitado').style.display = 'block';
      document.getElementById('iniciar_sesion').style.display = 'none';
      $('#email_inicio').removeAttr("required");
      $('#password').removeAttr("required");
      $('#name').prop("required", true);
      $('#email_invitado').prop("required", true);
      $('#direccion').prop("required", true);
    }
    
    var user_location = [-70.65028, -33.43778];

    var marker = null;

    mapboxgl.accessToken = 'pk.eyJ1IjoiZ2Fib2J1ZG8iLCJhIjoiY2trNHM1enR4MW9kczJ4cGV6NHlrdTA1bSJ9.H8tB-u1v17oj7NclhK3iBA';
    var map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: user_location,
      zoom: 10
    });
    //  geocoder here
    var geocoder = new MapboxGeocoder({
      accessToken: mapboxgl.accessToken,
      country: 'CL',
      placeholder: 'Escriba su dirección',
    });

    // After the map style has loaded on the page, add a source layer and default
    // styling for a single point.
    geocoder.on('result', function(ev) {

      user_location = ev.result.center;

      if (marker != null) {
        marker.remove();
      }

      addMarker(user_location);

      $('#direccion').val(ev.result.place_name);
      $('#latitud').val(ev.result.center[1]);
      $('#longitud').val(ev.result.center[0]);

    });

    function addMarker(ltlng) {

      marker = new mapboxgl.Marker({
          draggable: false,
          color: "#791313"
        })
        .setLngLat(user_location)
        .addTo(map);
    }

    document.getElementById('geocoder').appendChild(geocoder.onAdd(map));
  </script>

  @endsection