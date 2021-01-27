@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="header mt-5 mb-3">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <!-- Title -->
                            <h3 class="header-title">
                                Recuperar contraseña
                            </h3>
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row mt-5">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-5 mb-5">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-green">
                                    {{ __('Enviar link') }}
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
