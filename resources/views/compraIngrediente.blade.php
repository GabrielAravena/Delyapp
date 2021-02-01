@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="header mt-5 mb-3">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Title -->
                            <h3 class="header-title">
                                Compra de ingrediente
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{route('inventario.compra', $inventario )}}">
                        @csrf 

                        <div class="form-group row">
                            <label for="nombre_ingrediente" class="col-md-4 col-form-label text-md-right">Nombre ingrediente</label>

                            <div class="col-md-6">
                            <label class="col-md-6 col-form-label text-md-left">{{ $inventario-> nombre }}</label>
                            </div>
                        </div>
                     
                        <div class="form-group row">
                            <label for="cantidad_en_inventario" class="col-md-4 col-form-label text-md-right">Cantidad comprada</label>

                            <div class="col-md-4">
                                <input id="cantidad_en_inventario" min="1" max="100000" type="number" class="form-control text-center" name="cantidad" value="" required>
                            </div>
                            <label for="cantidad_en_inventario" class="col-md-4 col-form-label text-md-left">{{ $inventario-> unidad_medida }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Precio total</label>

                            <div class="col-md-6">
                                <input id="precio" min="1" max="1000000" type="number" class="form-control text-center" name="valor" value="" required>
                            </div>
                        </div>

                        <div class="form-inline row mb-3 text-center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-green">
                                    Ingresar
                                </button>
                                <a href="{{ route('inventario.index') }}" class="btn btn-primary btn-sm">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection