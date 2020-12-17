@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow" style="margin-top: 70px;">
                <div class="card-body">
                    <div class="row mt-5">
                        <img class="img ml-5" src="{{ 'https://localhost/delyapp_gabriel/public'.$producto->imagen }}" alt="Producto" width="350" height="250">
                        <div class="ml-5">
                            <h3>{{ $producto->nombre }}</h3>
                            <h5 class="mt-5">{{ $producto->descripcion }}</h5>
                            <h2 class="mt-5">Precio ${{ number_format($producto->precio, 0, ",", ".") }}</h2>
                            <form class="mt-5" method="post" action="{{ route('carrito.agregar', $producto) }}">
                                @csrf
                                <div class="form-inline">
                                    <label class="h5">Cantidad</label>
                                    <input class="form-control text-center ml-5" min="1" max="20" type="number" name="cantidad" value="1">
                                </div>
                                <div class="form-group row mb-5 mt-5">
                                    <div>
                                        <button type="submit" class="btn btn-green mr-3">
                                            Agregar al carrito
                                        </button>
                                    </div>
                                    <div>
                                        <a class="btn btn-primary text-white" href="javascript:history.back(-1);">
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

@endsection