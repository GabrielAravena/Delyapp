@extends('layouts.app')
@section('content')

<form method="POST" action="{{ $urlRedirection }}" id="redirect_form">
    <input type="hidden" name="token_ws" value="{{ $token_ws }}">
    <input type="hidden" id="monto" name="monto" value="{{ $monto }}">
    <input type="hidden" id="codigo" name="codigo" value="{{ $codigoAutorizacion }}">
</form>
<script>

    window.localStorage.setItem("monto", document.getElementById('monto').value);
    window.localStorage.setItem("codigoAutorizacion", document.getElementById('codigo').value);

    document.getElementById('redirect_form').submit();

</script>
@endsection