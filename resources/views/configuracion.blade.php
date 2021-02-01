@extends('layouts.dashboard')
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
                                Configuración de local
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-body">
                    <form method="POST" action="{{ route('configuracion.guardar') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row mt-5">
                            <div class="col-md-4 col-form-label text-md-right">
                                <label>Nombre del Local</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="nombre" type="text" class="form-control" value="{{ $local->nombre }}" name="nombre" required>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-md-right">
                                <label>Teléfono</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="telefono" type="tel" class="form-control" name="telefono" value="{{ $local->telefono }}" placeholder="Ejemplo: +56912345678" required>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-md-right">
                                <label>Ingreso mensual aproximado</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="ingreso_mensual" type="number" min="1" max="100000000000" class="form-control text-center" value="{{ number_format($local->ingreso_mensual, 0, '', '') }}" name="ingreso_mensual" required>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-md-right">
                                <label>Cuenta con delivery</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="delivery" type="checkbox" onclick="mostrar();" name="delivery">
                            </div>
                        </div>

                        <div class="form-group row mt-3" id="valor_delivery_container" style="display: none;">
                            <div class="col-md-4 col-form-label text-md-right">
                                <label>Valor delivery</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="valor_delivery" type="number" min="0" max="100000" class="form-control text-center" value="{{ number_format($local->valor_delivery, 0, '', '') }}" name="valor_delivery">
                            </div>
                        </div>

                        <div class="form-group row mt-3" id="distancia_delivery_container" style="display: none;">
                            <div class="col-md-4 col-form-label text-md-right">
                                <label>Distancia máxima a la que despachas (en Km)</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="distancia_delivery" type="number" min="1" max="1000" class="form-control text-center" value="{{ number_format($local->distancia_delivery, 0, '', '') }}" name="distancia_delivery">
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-md-right">
                                <label>Porcentaje de ganancia (%)</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="ganancia" type="number" min="0" max="100" class="form-control text-center" value="{{ number_format($local->ganancia, 0, '', '') }}" name="ganancia" required>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-md-right">
                                <label>Imagen del local</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input class="file" type="file" name="imagen_local" id="imagen_local" data-show-preview="false" accept="image/*" />
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-md-right">
                                <label>Logo local</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input class="file" type="file" name="logo_local" id="logo_local" data-show-preview="false" accept="image/*" />
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-md-right">
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
                        <input type="text" id="direccion" name="direccion" value="{{ $local->direccion }}" hidden required>
                        <input type="text" id="latitud" name="latitud" value="{{ $local->latitud }}" hidden>
                        <input type="text" id="longitud" name="longitud" value="{{ $local->longitud }}" hidden>

                        <div class="form-inline row mb-5 mt-5">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-green" onclick="activarSpinner();">
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

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        if({{ $local->delivery }}){
            $('#delivery').prop("checked", true);
            document.getElementById('valor_delivery_container').style.display = 'flex';
            document.getElementById('distancia_delivery_container').style.display = 'flex';
            $('#valor_delivery').prop("required", true);
            $('#distancia_delivery').prop("required", true);
        }
    });

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
            placeholder: 'Seleccione una imagen',
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

    var user_location = [{{ $local->longitud }}, {{ $local->latitud }}];

    var marker = null;

    mapboxgl.accessToken = 'pk.eyJ1IjoiZ2Fib2J1ZG8iLCJhIjoiY2trNHM1enR4MW9kczJ4cGV6NHlrdTA1bSJ9.H8tB-u1v17oj7NclhK3iBA';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: user_location,
        zoom: 15,
    });
    //  geocoder here
    var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        country: 'CL',
        placeholder: '{{ $local->direccion }}',
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

    map.on('load', function() {
    addMarker(user_location, 'load');
    });

    document.getElementById('geocoder').appendChild(geocoder.onAdd(map));
</script>
@endsection