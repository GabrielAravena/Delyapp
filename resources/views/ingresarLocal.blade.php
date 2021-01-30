@extends('layouts.app')
@section('content')
<div class="container" id="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Header -->
            <div class="header mt-5 mb-3">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Title -->
                            <h3 class="header-title">
                                Ingresar local
                            </h3>
                            @if(session('mensaje'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Perfecto: </strong> {{ session('mensaje') }}
                                <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                                    <span>&times;</span>
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-body">
                    <form method="POST" action="{{ route('root.guardar') }}" enctype="multipart/form-data">
                        @csrf

                        <h4 class="mt-3 text-center">Datos del local</h4>

                        <div class="form-group row mt-5">
                            <div class="col-md-4 col-form-label text-right">
                                <label>Nombre del Local</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="nombre" type="text" class="form-control" name="nombre" required>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-right">
                                <label>Teléfono</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="telefono" type="tel" class="form-control" name="telefono" placeholder="Ejemplo: +56912345678" required>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-right">
                                <label>Ingreso mensual aproximado</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="ingreso_mensual" type="number" min="0" max="100000000000" class="form-control text-center" value="" name="ingreso_mensual">
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-right">
                                <label>Cuenta con delivery</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="delivery" type="checkbox" onclick="mostrar();" name="delivery">
                            </div>
                        </div>

                        <div class="form-group row mt-3" id="valor_delivery_container" style="display: none;">
                            <div class="col-md-4 col-form-label text-right">
                                <label>Valor delivery</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="valor_delivery" type="number" min="0" max="100000" class="form-control text-center" name="valor_delivery">
                            </div>
                        </div>

                        <div class="form-group row mt-3" id="distancia_delivery_container" style="display: none;">
                            <div class="col-md-4 col-form-label text-right">
                                <label>Distancia máxima a la que despachas (en Km)</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="distancia_delivery" type="number" min="0" max="100" class="form-control text-center" name="distancia_delivery">
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-right">
                                <label>Porcentaje de ganancia (%)</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="ganancia" type="number" min="0" max="100" class="form-control text-center" name="ganancia">
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-right">
                                <label>Imagen del local</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input class="file" type="file" name="imagen_local" id="imagen_local" data-show-preview="false" accept="image/*" />
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-right">
                                <label>Logo local</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input class="file" type="file" name="logo_local" id="logo_local" data-show-preview="false" accept="image/*" />
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-right">
                                <label>Dirección</label>
                            </div>
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

                        <h4 class="text-center" style="margin-top: 180px;">Datos del administrador</h4>

                        <div class="form-group row mt-5">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control col-form-label @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <input type="text" id="direccion" name="direccion" hidden required>
                        <input type="text" id="latitud" name="latitud" hidden>
                        <input type="text" id="longitud" name="longitud" hidden>

                        <div class="form-inline row mt-5 mb-5">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-green">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />

<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('#logo_local').fileinput({
            language: 'es',
            allowedFileExtensions: ['jpg', 'jpeg', 'png'],
            maxFileSize: 1000,
            showUpload: false,
            showRemove: false,
            showClose: false,
            initialPreviewAsData: false,
            dropZoneEnabled: false,
            theme: 'fas',
        });
    });

    $(document).ready(function() {
        $('#imagen_local').fileinput({
            language: 'es',
            allowedFileExtensions: ['jpg', 'jpeg', 'png'],
            maxFileSize: 1000,
            showUpload: false,
            showRemove: false,
            showClose: false,
            initialPreviewAsData: false,
            dropZoneEnabled: false,
            theme: 'fas',
        });
    });

    function mostrar() {
        display = document.getElementById('valor_delivery_container').style.display;
        if (display == 'none') {
            document.getElementById('valor_delivery_container').style.display = 'flex';
            document.getElementById('distancia_delivery_container').style.display = 'flex';
            $('#valor_delivery').prop("required", true);
            $('#distancia_delivery').prop("required", true);
        } else {
            document.getElementById('valor_delivery_container').style.display = 'none';
            document.getElementById('distancia_delivery_container').style.display = 'none';
            $('#valor_delivery').prop("required", false);
            $('#distancia_delivery').prop("required", false);
        }
    }

    var user_location = [-70.65028, -33.43778];

    var marker = null;

    mapboxgl.accessToken = 'pk.eyJ1IjoiZ2Fib2J1ZG8iLCJhIjoiY2trNHM1enR4MW9kczJ4cGV6NHlrdTA1bSJ9.H8tB-u1v17oj7NclhK3iBA';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: user_location,
        zoom: 10,
    });
    //  geocoder here
    var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        country: 'CL',
        placeholder: 'Ingrese dirección',
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