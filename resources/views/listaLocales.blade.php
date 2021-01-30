@extends('layouts.app')
@section('content')
<div class="main-content">
    <div class="container" id="container">
        <div class="row justify-content-center">
            <div class="col-12">

                <!-- Header -->
                <div class="header mt-5 mb-3">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col-12">

                                <!-- Title -->
                                <h3 class="header-title">
                                    Locales
                                </h3>
                                @if(session('mensaje'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Perfecto: </strong> {{ session('mensaje') }}
                                    <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                @endif
                                <div class="mt-5 form-inline">
                                    <label>Buscar local</label>
                                    <input id="buscador" class="ml-3" type="text" placeholder="Buscar local">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team name -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">

                            <!-- Files -->
                            <div class="card">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th class="col-3" style="text-align:center" scope="col">Nombre</th>
                                            <th class="col-4" style="text-align:center" scope="col">Dirección</th>
                                            <th class="col-2" style="text-align:left" scope="col">Teléfono</th>
                                            <th style="text-align:left" scope="col">Estado</th>
                                            <th style="text-align:left" scope="col">Modificar</th>
                                            <th style="text-align:left" scope="col">Activar/ Desactivar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaLocales">
                                        @foreach($locales as $local)
                                        <tr>
                                            <td style="vertical-align: middle">{{ $local->nombre }}</td>
                                            <td style="vertical-align: middle">{{ $local->direccion }}</td>
                                            <td style="vertical-align: middle">{{ $local->telefono }}</td>
                                            <td style="vertical-align: middle">{{ $local->estado }}</td>
                                            <td style="text-align:center; vertical-align: middle">
                                                <a href="{{ route('root.modificar', $local->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="green" class="bi bi-pencil" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td style="text-align:center; vertical-align: middle">
                                                @if($local->estado == 'activado')
                                                <a href="{{ route('root.activarLocal', $local)}}">
                                                    <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-check2-square" fill="green" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                                        <path fill-rule="evenodd" d="M1.5 13A1.5 1.5 0 0 0 3 14.5h10a1.5 1.5 0 0 0 1.5-1.5V8a.5.5 0 0 0-1 0v5a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V3a.5.5 0 0 1 .5-.5h8a.5.5 0 0 0 0-1H3A1.5 1.5 0 0 0 1.5 3v10z" />
                                                    </svg>
                                                </a>
                                                @else
                                                <a href="{{ route('root.activarLocal', $local)}}">
                                                    <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-x-square" fill="red" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                    </svg>
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-5 mb-5 text-center">
                                {{ $locales->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

<script>
    $(document).on('keyup', '#buscador', function() {
        var texto = $(this).val();
        buscar(texto);
    });

    function buscar(texto) {
        $.ajax({
                url: 'buscadorLocales?texto=' + texto,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(respuesta) {
                document.getElementById('tablaLocales').innerHTML = respuesta;
            })
            .fail(function() {
                console.log("error");
            })
    }
</script>

@endsection