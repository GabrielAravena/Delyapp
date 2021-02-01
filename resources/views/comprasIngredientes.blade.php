@extends('layouts.dashboard')
@section('content')

<div class="container" id="container">
    <div class="row">
        <div class="header mt-5 mb-3">
            <div class="header-body form-inline col-12">
                <!-- Title -->
                <h3 class="header-title">
                    Compras de ingredientes
                </h3>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mt-5 ml-5">
                        <label for="fechas" class="h5">Buscar por fechas</label>
                    </div>
                    <form method="POST" action="{{ route('inventario.buscarComprasIngredientes', $local_id) }}" id="formData">
                        @csrf
                        <div class="form-inline ml-5 mr-5 mt-5">
                            <div class="form-inline">
                                <label for="desde">Desde</label>
                                <input class="ml-3 mr-5" type="date" name="desde" id="desde" required>
                            </div>
                            <div class="form-inline">
                                <label for="hasta">Hasta</label>
                                <input class="ml-3" type="date" name="hasta" id="hasta" required>
                            </div>
                        </div>

                        <div class="form-inline ml-5 mr-5 mt-5 mb-5">
                            <button class="btn btn-green ml-3 mr-3" type="submit">Buscar</button>
                            <a class="btn btn-warning text-white ml-3 mr-3" href="#" type="button" id="descargar">Descargar excel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script>
    $('#descargar').click(function(event) {

        event.preventDefault();

        var desde = $('#desde').val();
        var hasta = $('#hasta').val();

        if (desde != "" && hasta != "" && desde <= hasta) {

            window.location = "comprasIngredientes/descargar/" + desde + "/" + hasta + "";

        }
    });
</script>

@endsection