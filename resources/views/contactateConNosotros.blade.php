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
                                Contáctate por nosotros
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-body">
                    <form method="POST" action="{{ route('inicio.enviarContacto') }}">
                        @csrf

                        <div class="form-group row mt-5">
                            <div class="col-md-4 col-form-label text-md-right">
                                <label>Nombre</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-4 col-form-label text-md-right">
                                <label>Teléfono</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <input id="telefono" type="tel" class="form-control" name="telefono" placeholder="Ejemplo: 912345678" pattern="[0-9]{9}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo electrónico</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">

                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-5">
                            <div class="col-md-4 col-form-label text-md-right">
                                <label>Mensaje</label>
                            </div>
                            <div class="col-md-6 text-left">
                                <textarea type="textarea" maxlength="225" class="form-control" name="mensaje" required></textarea>
                            </div>
                        </div>

                        <div class="form-inline row mb-5 mt-5">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-green">
                                    Enviar
                                </button>
                                <a class="btn btn-primary" href="javascript:history.back()">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection