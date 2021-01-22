@extends('layouts.dashboard')
@section('content')
<div class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-5">
                <!-- Header -->
                <div class="header mt-5 mb-3">
                    <div class="header-body form-inline col-12">
                        <!-- Title -->
                        <h3 class="header-title">
                            Detalle pérdidas
                        </h3>
                    </div>
                </div>

                <!-- Team name -->
                <div class="form-group mb-0">
                    <div class="row">
                        <div class="col-12">

                            <!-- Files -->
                            <div class="card">

                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center" scope="col">Nombre</th>
                                            <th style="text-align:center" scope="col">Cantidad desperdiciada</th>
                                            <th style="text-align:center" scope="col">Unidad de medida</th>
                                            <th style="text-align:center" scope="col">Valor desperdiciado</th>
                                            <th style="text-align:center" scope="col">Fecha registro</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($detalleDesperdicio as $detalle)
                                        <tr>
                                            <td style="text-align:center">{{ $detalle->nombre }}</td>
                                            <td style="text-align:center">{{ number_format($detalle->desperdicio, 0, ",", ".") }}</td>
                                            <td style="text-align:center">{{ $detalle->unidad_medida }}</td>
                                            <td style="text-align:center">{{ number_format($detalle->valor_desperdiciado, 0, ",", ".") }}</td>
                                            <td style="text-align:center">{{ $detalle->created_at }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td style="text-align:center"></td>
                                            <td style="text-align:center"></td>
                                            <td style="text-align:center"></td>
                                            <td style="text-align:center"></td>
                                            <td style="text-align:center"> <strong>TOTAL: {{ number_format($totalPerdida, 0, ",", ".") }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" id="perdida_id" value="{{ $perdida_id }}" hidden/>
                <div class="col-md-6 text-right" style="float:right">
                    <a href="#" id="descargar" class="btn btn-green btn-sm mt-3">Descargar Excel</a>
                    <a href="{{ route('inventario.perdidas') }}" class="btn btn-primary btn-sm mt-3">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script>

    $('#descargar').click(function(event) {

        event.preventDefault();

        var perdida_id = $('#perdida_id').val();

        window.location = "descargar/" + perdida_id;

    });
</script>

@endsection