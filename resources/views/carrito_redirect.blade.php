@extends('layouts.app')
@section('content')

<form method="POST" action="{{ $urlRedirection }}" id="redirect_form">
    <input type="hidden" name="token_ws" value="{{ $token_ws }}">
    <input type="hidden" id="monto" name="monto" value="{{ $monto }}">
    <input type="hidden" id="codigo" name="codigo" value="{{ $codigoAutorizacion }}">
</form>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function agregar() {

        var monto = $('#monto').val();
        var codigo = $('#codigo').val();

        window.localStorage.setItem("monto", monto);
        window.localStorage.setItem("codigoAutorizacion", codigo);

        document.getElementById('redirect_form').submit();


    });
</script>
@endsection