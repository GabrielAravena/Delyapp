@extends('layouts.dashboard')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
                <!-- Header -->
                <div class="header mt-5 mb-3">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Title -->
                            <h3 class="header-title">
                                Modificar producto
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <form method="POST" action="{{ route('menu.ingresarModificacion') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div>
                            <div class="form-inline row mt-3">
                                <label class="col-md-2 col-form-label text-md-left">Nombre del producto</label>
                                <input id="nombre" type="text" class="col-md-2 form-control text-md-left" name="nombre" value="{{ $producto->nombre }}" required>
                            </div>
                            <div class="form-group mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card justify-content-center">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:left">Nombre</th>
                                                        <th style="text-align:center">Cantidad</th>
                                                        <th style="text-align:center">Unidad de medida</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach($ingredientes as $ingrediente)
                                                    <tr>
                                                        <td style="text-align:left">{{ $ingrediente->nombre }}</td>
                                                        <td style="text-align:center">{{ number_format($ingrediente->cantidad, 0, ',', '') }}</td>
                                                        <td style="text-align:center">{{ $ingrediente->unidad_medida }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-inline row mt-3">
                                <label class="col-md-2 col-form-label" style="justify-content: right;">Categoria</label>
                                <div class="col-md-3 pl-0">
                                    <select class="col-md-2 form-control text-center" name="categoria" id="categoria" selected="Combo">
                                        <option value="promoción">Promoción</option>
                                        <option value="promoción principal">Promoción principal</option>
                                        <option value="combo">Combo</option>
                                        <option value="pizzas">Pizzas</option>
                                        <option value="completos">Completos</option>
                                        <option value="hamburguesas">Hamburguesas</option>
                                        <option value="sushi">Sushi</option>
                                        <option value="fajitas">Fajitas</option>
                                        <option value="papas frita">Papas fritas</option>
                                        <option value="pollo">Pollo</option>
                                        <option value="sándwiches">Sándwiches</option>
                                        <option value="churrascos">Churrascos</option>
                                        <option value="empanadas">Empanadas</option>
                                        <option value="carnes">Carnes</option>
                                        <option value="chorrillanas">Chorrillanas</option>
                                        <option value="postres">Postres</option>
                                        <option value="ensaladas">Ensaladas</option>
                                        <option value="bebidas">Bebidas</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-inline row mt-3">
                                <label class="col-md-2 col-form-label" style="justify-content: right;">Tiempo de preparación</label>
                                <input id="cantidad_en_inventario" max="1000" min="1" type="number" class="col-md-2 form-control text-center" name="tiempo_preparacion" value="{{ number_format($producto->tiempo_preparacion, 0, ',', '') }}" required>
                                <label class="col-md-2 col-form-label" style="justify-content: left;">minutos</label>
                            </div>

                            <div class="form-inline row mt-3">
                                <label class="col-md-2 col-form-label" style="justify-content: right;">Descripción del producto</label>
                                <textarea type="textarea" maxlength="225" class="col-md-8 form-control text-md-left" name="descripcion" value="{{ $producto->descripcion }}" required>{{ $producto->descripcion }}</textarea>
                            </div>

                            <div class="form-inline row mt-3">
                                <label class="col-md-2 col-form-label" style="justify-content: right;">Imagen del producto</label>
                                <input class="file" type="file" name="imagen" id="imagen" data-show-preview="false" accept="image/*" />
                            </div>

                            <div class="form-inline row offset-md-2 mt-5">
                                <label class="col-md-2">Precio sugerido</label>
                                <label class="col-md-2 h5"><strong>$ {{ number_format($producto->precio_sugerido, 0, ",", ".") }}</strong></label>
                            </div>

                            <div class="form-inline row offset-md-2 mt-5">
                                <label class="ml-3">
                                    <input id="sugerido" name="radio" type="radio" value="sugerido" onclick="ocultar();" checked />
                                    <span class="ml-3">Utilizar precio sugerido</span>
                                </label>
                            </div>

                            <div class="form-inline row offset-md-2 mt-3">
                                <label class="ml-3">
                                    <input id="otro" name="radio" type="radio" value="otro" onclick="mostrar();" />
                                    <span class="ml-3">Utilizar otro precio</span>
                                </label>
                                <input id="precio" max="100000" min="1" type="number" class="col-md-2 form-control text-center ml-5" name="precio" value="{{ number_format($producto->precio, 0, ',', '') }}" style="display:none" />
                            </div>

                            <input class="d-none" type="text" name="producto_id" value="{{ $producto->id }}">

                            <div class="form-group row mt-5 mb-3">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-green mr-3">
                                        Guardar
                                    </button>
                                    <a href="{{ route('menu.index') }}" class="btn btn-primary">Volver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#imagen').fileinput({
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
            document.getElementById('precio').style.display = 'block';
            $('#precio').prop("required", true);
        }

        function ocultar() {
            document.getElementById('precio').style.display = 'none';
            $('#precio').removeAttr("required");
        }
    </script>

    @endsection