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
                                Configuración
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-body">
                    <form method="POST" action="{{ route('inicio.guardarConfiguracion') }}">
                        @csrf

                        <div class="form-group row mt-5">
                            <div class="col-md-4 col-form-label text-right">
                                <label>Nombre</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="nombre" type="text" class="form-control" value="{{ $user->name }}" name="nombre" required>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-right">
                                <label>Teléfono</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="telefono" type="tel" class="form-control" name="telefono" value="{{ $user->telefono }}" placeholder="Ejemplo: 912345678" pattern="[0-9]{9}" required>
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
                        <input type="text" id="direccion" name="direccion" value="{{ $user->direccion }}" hidden required>
                        <input type="text" id="latitud" name="latitud" value="{{ $user->latitud }}" hidden>
                        <input type="text" id="longitud" name="longitud" value="{{ $user->longitud }}" hidden>

                        <div class="form-inline row mb-5" style="margin-top: 180px;">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-green">
                                    Guardar
                                </button>
                                <a href="javascript:history.back()" class="btn btn-primary">Volver</a>
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

    var user_location = [{{ $user->longitud }}, {{ $user->latitud }}];

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
        placeholder: '{{ $user->direccion }}',
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