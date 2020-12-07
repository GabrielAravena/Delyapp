@extends('layouts.app')
@section('content')
<form method="POST" action="{{ $url }}" id="pagar_form">
    <input type="hidden" name="token_ws" value="{{ $token_ws }}">
</form>
<script>
    document.getElementById('pagar_form').submit();
</script>
@endsection