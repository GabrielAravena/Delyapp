@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top:50px">
                <div class="card-header">Compra de ingrediente</div>

                <div class="card-body">
                    <form method="POST" action="{{route('inventario.compra', $inventario )}}">
                        @csrf 

                        <div class="form-group row">
                            <label for="nombre_ingrediente" class="col-md-4 col-form-label text-md-right">Nombre ingrediente</label>

                            <div class="col-md-6">
                            <label class="col-md-4 col-form-label text-md-left">{{ $inventario-> nombre }}</label>
                            </div>
                        </div>
                     
                        <div class="form-group row">
                            <label for="cantidad_en_inventario" class="col-md-4 col-form-label text-md-right">Cantidad comprada</label>

                            <div class="col-md-4">
                                <input id="cantidad_en_inventario" type="number" class="form-control" name="cantidad" value="">
                            </div>
                            <label for="cantidad_en_inventario" class="col-md-4 col-form-label text-md-left">{{ $inventario-> unidad_medida }}</label>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Precio total</label>

                            <div class="col-md-6">
                                <input id="precio" type="number" class="form-control" name="valor" value="">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-green">
                                    Ingresar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection