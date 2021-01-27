@extends('layouts.app')
@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="card shadow" style="margin-top: 70px;">
            <div class="card-body text-center">
                <div class="ml-5">
                    <div class="row justify-content-center mt-5">
                        <img class="img ml-5" src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Commons-emblem-success.svg/1024px-Commons-emblem-success.svg.png" alt="Producto" width="80" height="80">
                        <h2>¡Compra exitosa!</h2>
                    </div>
                    <h5 class="mt-5">Detalle de compra</h5>
                    <div class="row offset-md-4">
                        <h6 class="mt-5">Monto: </h6>
                        <h6 class="mt-5 ml-3" id="monto"></h6>
                    </div>
                    <div class="row mb-5 offset-md-4">
                        <h6 class="mt-5">Código de autorización: </h6>
                        <h6 class="mt-5 ml-3" id="codigo"></h6>
                    </div>
                    <div class="col-12 text-center">
                        <label>Te hemos enviado un correo electrónico con el detalle de tu compra</label>
                    </div>
                    <a class="btn btn-green text-white mt-5 mb-5" type="button" href="{{ route('inicio') }}">
                        Inicio
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('monto').innerHTML = "$" + window.localStorage.getItem('monto');
    document.getElementById('codigo').innerHTML = window.localStorage.getItem('codigoAutorizacion');
</script>

@endsection