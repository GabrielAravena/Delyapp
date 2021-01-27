@extends('layouts.app')
@section('content')
<div class="container" id="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow" style="margin-top: 70px;">
                <div class="card-body">
                    <div class="row mt-5">
                        <img class="img ml-5" src="{{ asset($producto->imagen) }}" alt="Producto" width="350" height="250">
                        <div class="ml-5">
                            <h3>{{ $producto->nombre }}</h3>
                            <h5 class="mt-5">{{ $producto->descripcion }}</h5>
                            <h2 class="mt-5">Precio ${{ number_format($producto->precio, 0, ",", ".") }}</h2>
                            <form class="mt-5" method="post" id="form" action="{{ route('carrito.agregar', $producto) }}">
                                @csrf
                                <div class="form-inline">
                                    <label class="h5">Cantidad</label>
                                    <input class="form-control text-center ml-5" min="1" max="20" type="number" name="cantidad" value="1">
                                </div>
                                <div class="form-group row mb-5 mt-5">
                                    <div>
                                        <button type="submit" onclick="enviar()" class="btn btn-green mr-3">
                                            Agregar al carrito
                                        </button>
                                    </div>
                                    <div>
                                        <a class="btn btn-primary text-white" href="{{ route('local.index', $producto->local_id) }}">
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
    </div>
</div>

<div class="text-center" id="spinner" style="margin-top: 300px" hidden>
    <div class="spinner-grow" style="width: 5rem; height: 5rem; color: #791313;" role="status">
        <span class="visually-hidden"></span>
    </div>
    <div class="spinner-grow" style="width: 5rem; height: 5rem; color: #f9b129;" role="status">
        <span class="visually-hidden"></span>
    </div>
    <div class="spinner-grow" style="width: 5rem; height: 5rem; color: #137830;" role="status">
        <span class="visually-hidden"></span>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

<script>

    function enviar(){
        $('#container').prop('hidden', true);
        $('#spinner').prop('hidden', false);
     
    }

</script>

@endsection