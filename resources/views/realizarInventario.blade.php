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
                                Realizar inventario
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('inventario.ingresarInventario') }}">
                        @csrf
                        @foreach($inventarios as $inventario)
                        <div class="form-inline row mt-5 justify-content-center">
                            <div class="col-md-4 text-center">
                                <label>Ingrediente: {{ $inventario->nombre }}</label>
                            </div>
                            
                            <div class="form-inline col-md-4 justify-content-center">
                                <label class="text-center">Cantidad </label>
                                <input id="{{ $inventario->id }}" min="1" max="9999" type="number" class="form-control text-center ml-3" name="{{ $inventario->id }}" required>
                            </div>
                            <div class="col-md-4 text-center">
                                <label>Unidad de medida: {{ $inventario->unidad_medida }}</label>
                            </div>
                        </div>
                        @endforeach
                        <div class="form-inline row mt-5 mb-3 mt-5 text-center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-green">
                                    Confirmar
                                </button>
                                <a href="{{ route('inventario.index') }}" class="btn btn-primary">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection