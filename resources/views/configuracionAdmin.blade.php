@extends('layouts.app')
@section('content')
<div class="container" id="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Header -->
            <div class="header mt-5 mb-3">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Title -->
                            <h3 class="header-title">
                                Configuración del administrador
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-body">
                    <form method="POST" action="{{ route('configuracion.guardarAdmin') }}">
                        @csrf

                        <div class="form-group row mt-5">
                            <div class="col-md-4 col-form-label text-right">
                                <label>Nombre</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="nombre" type="text" class="form-control" value="{{ $admin->name }}" name="nombre" required>
                            </div>
                        </div>

                        <div class="form-inline row mt-5 mb-5">
                            <div class="col-md-12 text-center">
                                <a href="{{ route('password.request') }}" class="btn btn-green">Cambiar contraseña</a>
                            </div>
                        </div>

                        <div class="form-inline row mb-5">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-green">
                                    Guardar
                                </button>
                                <a href="javascript:history.back()" class="btn btn-primary">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection