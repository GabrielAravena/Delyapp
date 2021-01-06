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
                                Modificar gasto fijo
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('gastosFijos.ingresarModificacion') }}">
                        @csrf
                        <div class="form-inline row mt-5">
                            <label class="col-md-4 col-form-label">Nombre gasto</label>
                            <label class="col-md-4 col-form-label">{{ $gasto->nombre }}</label>
                        </div>
                        <div class="form-inline row mt-3">
                            <label for="valor" class="col-md-4 col-form-label">Monto</label>
                            <input id="monto" type="number" min="1" max="10000000" class="form-control text-center" name="monto" value="{{ number_format($gasto->monto, 0, ',', '') }}" required>
                            <label class="col-md-2 col-form-label text-left">Mensuales</label>
                        </div>

                        <input class="d-none" id="gasto_id" name="gasto_id" type="text" value="{{ $gasto->id }}">

                        <div class="form-inline row mb-3 mt-5">
                            <div class="col-md-12 offset-md-3">
                                <button type="submit" class="btn btn-green">
                                    Ingresar
                                </button>
                                <a type="button" href="{{ route('gastosFijos.index') }}" class="btn btn-primary text-white">
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
@endsection