@extends('layouts.dashboard')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Header -->
            <div class="header mt-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <!-- Title -->
                            <h3 class="header-title">
                                Vender
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Ingresar productos</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('vender.store') }}">
                        @csrf

                        <table id="tablaNuevoProducto" class="table table-md">
                            <tr>
                                <div class="form-inline row mt-5 justify-content-center">
                                    <div class="col-md-2 text-md-right">
                                        <label class="text-md-right">Producto</label>
                                    </div>
                                    <div class="col-md-3">
                                        <select id="producto1" type="text" class="form-control" name="producto1">
                                            @foreach($productos as $producto)
                                            <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 text-md-right">
                                        <label class="col-md-12 col-form-label text-md-right">Cantidad</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input id="cantidad1" max="999999" type="number" class="col-md-12 form-control text-md-left" name="cantidad1" required>
                                    </div>
                                </div>
                            </tr>
                        </table>
                        <a id="btnAgregarProducto" role="button" class="offset-md-2 mt-5">
                            <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-plus-circle ml-3 mt-3 mb-3" fill="green" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                        </a>
                        <div class="row justify-content-center text-center mt-5">
                            <button type="submit" id="confirmarIngredientes" type="submit" class="col-md-4 btn btn-primary text-white">Confirmar productos</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

<script>
    /* Agrega una fila a la tabla para agregar ingredientes */
    $(document).ready(function() {
        var c = 1;
        $('#btnAgregarProducto').click(function() {
            c++;
            $('#tablaNuevoProducto').append(
                '<div>' +
                
                '<div class="form-inline row mt-5 justify-content-center">' +
                '<div class="col-md-2 text-md-right">' +
                '<label class="col-md-12 col-form-label text-md-right">Producto</label>' +
                '</div>' +
                '<div class="col-md-3">' +
                '<select id="producto' + c + '" type="text" class="form-control" name="producto' + c + '" value="" >' +
                '@foreach($productos as $producto)' +
                '<option value="{{$producto->id}}">{{$producto->nombre}}</option>' +
                '@endforeach' +
                '</select>' +
                '</div>' +
                '<div class="col-md-2 text-md-right">' +
                '<label class="col-md-12 col-form-label text-md-right">Cantidad</label>' +
                '</div>' +
                '<div class="col-md-2">' +
                '<input id="cantidad' + c + '" max="999999" type="number" class="form-control col-md-12 text-md-left" name="cantidad' + c + '" required>' +
                '</div>' +
                '</div>' +
                '</div>'
            );
        });
    });
</script>
@endsection