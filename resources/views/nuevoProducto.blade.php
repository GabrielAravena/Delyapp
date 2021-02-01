@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Header -->
            <div class="header mt-5 mb-3">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <!-- Title -->
                            <h3 class="header-title">
                                Nuevo producto
                            </h3>
                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error: </strong> {{ session('error') }}
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
                    <form method="POST" action="{{ route('menu.store') }}">
                        @csrf

                        <div class="form-group row mt-3">
                            <label for="nombre_ingrediente" class="col-md-2 col-form-label text-md-left">Nombre del producto</label>
                            <input id="nombre_ingrediente" maxlength="225" type="text" class="col-md-4 form-control text-md-left" name="nombre_ingrediente" value="" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">Ingredientes</div>
                                        <table class="table table-md">
                                            <tbody id="tablaNuevoProducto">
                                                <tr>
                                                    <div class="form-group row">
                                                        <td>
                                                            <label class="col-md-12 col-form-label text-md-left">Ingrediente</label>
                                                        </td>
                                                        <td>
                                                            <select id="ingrediente1" type="text" class="form-control" name="ingrediente1">
                                                                @foreach($inventarios as $inventario)
                                                                <option value="{{ $inventario->id }}">{{ $inventario->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <label class="col-md-12 col-form-label text-md-left">Cantidad</label>
                                                        </td>
                                                        <td>
                                                            <input id="cantidad1" min="1" max="1000" type="number" class="col-md-12 form-control text-center" name="cantidad1" required>
                                                        </td>
                                                        <td>
                                                            <label class="col-md-12 col-form-label text-md-left">Unidad de medida</label>
                                                        </td>
                                                        <td>
                                                            <select id="unidad_medida1" type="text" class="form-control" name="unidad_medida1" value="">
                                                                <option value="Kilogramo">Kilogramo</option>
                                                                <option value="Gramo" selected>Gramo</option>
                                                                <option value="Litro">Litro</option>
                                                                <option value="Ml">Ml</option>
                                                                <option value="Unidad">Unidad</option>
                                                            </select>
                                                        </td>
                                                    </div>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div>
                                            <a id="btnAgregarIngrediente" role="button">
                                                <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-plus-circle ml-3 mt-3 mb-3" fill="green" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                </svg>
                                            </a>
                                            <a id="btnQuitar" role="button" class="ml-5 mt-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="3em" height="3em" fill="red" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <button type="submit" id="confirmarIngredientes" class="btn btn-green mr-1 mt-3">Confirmar ingredientes</button>
                            <a href="{{ route('menu.index') }}" class="btn btn-primary ml-1 mt-3">Volver</a>
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
        $('#btnAgregarIngrediente').click(function() {
            c++;
            $('#tablaNuevoProducto').append(
                '<tr id="fila' + c + '">' +
                '<div class="form-group row">' +
                '<td>' +
                '<label class="col-md-12 col-form-label text-md-left">Ingrediente</label>' +
                '</td>' +
                '<td>' +
                '<select id="ingrediente1" type="text" class="form-control" name="ingrediente' + c + '" value="" >' +
                '@foreach($inventarios as $inventario)' +
                '<option value="{{ $inventario->id }}">{{ $inventario->nombre }}</option>' +
                '@endforeach' +
                '</select>' +
                '</td>' +
                '<td>' +
                '<label class="col-md-12 col-form-label text-md-left">Cantidad</label>' +
                '</td>' +
                '<td>' +
                '<input id="cantidad' + c + '" min="1" max="1000" type="number" class="col-md-12 form-control text-center" name="cantidad' + c + '" required>' +
                '</td>' +
                '<td>' +
                '<label class="col-md-12 col-form-label text-md-left">Unidad de medida</label>' +
                '</td>' +
                '<td>' +
                '<select id="unidad_medida' + c + '" type="text" class="form-control" name="unidad_medida' + c + '" value="" >' +
                '<option value="Kilogramo">Kilogramo</option>' +
                '<option value="Gramo" selected>Gramo</option>' +
                '<option value="Litro" >Litro</option>' +
                '<option value="Ml">Ml</option>' +
                '<option value="Unidad">Unidad</option>' +
                '</select>' +
                '</td>' +
                '</div>' +
                '</tr>'
            );
        });
        $('#btnQuitar').click(function() {

            $('#fila' + c).remove();
            c--;

        });
    });
</script>
@endsection