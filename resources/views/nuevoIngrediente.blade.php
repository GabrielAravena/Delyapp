@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Header -->
            <div class="header mt-5 mb-3">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Title -->
                            <h3 class="header-title">
                                Nuevo ingrediente
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('inventario.store')}}">
                        @csrf
                        <div class="form-inline row mt-5">
                            <label class="col-md-4 col-form-label text-md-right">Nombre ingrediente</label>

                            <div class="col-md-6">
                                <select id="nombre_ingrediente" class="form-control" name="mermaId">
                                    @foreach($mermas as $merma)
                                    <option value="{{ $merma->id }}">{{ $merma->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-inline row mt-3">
                            <label for="unidad_medida" class="col-md-4 col-form-label text-md-right">Unidad de medida</label>

                            <div class="col-md-6">
                                <select id="unidad_medida" class="form-control" name="unidad_medida" onchange="showSelected();">
                                    <option value="Kilogramo">Kilogramo</option>
                                    <option value="Gramo" selected>Gramo</option>
                                    <option value="Litro">Litro</option>
                                    <option value="Ml">Ml</option>
                                    <option value="Unidad">Unidad</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-inline row mt-3">
                            <label for="cantidad_en_inventario" class="col-md-4 col-form-label text-md-right">Cantidad en inventario</label>

                            <div class="col-md-6">
                                <input id="cantidad_en_inventario" type="number" min="1" max="1000" class="form-control text-center" name="cantidad" required>
                            </div>
                        </div>

                        <div class="form-inline row mt-3">
                            <div class="col-md-4 text-md-right">
                                <label>Precio por cada</label>
                                <label id="precio_por_cada">Gramo</label>
                            </div>
                            <div class="col-md-6">
                                <input id="precio" type="number" min="1" max="100000" class="form-control text-center" name="precio" required>
                            </div>
                        </div>

                        <div class="form-inline row mb-3 mt-5">
                            <div class="col-md-12 offset-md-3">
                                <button type="submit" class="btn btn-green">
                                    Ingresar
                                </button>
                                <a type="button" href="{{ route('inventario.index') }}" class="btn btn-primary text-white">
                                    Volver
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function showSelected() {
        var cod = document.getElementById("unidad_medida").value;
        document.getElementById('precio_por_cada').innerHTML = cod;
    }
</script>
@endsection