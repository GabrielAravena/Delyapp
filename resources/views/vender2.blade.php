@extends('layouts.dashboard')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Header -->
            <div class="header mt-md-5">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <!-- Title -->
                            <h3 class="header-title">
                                Vender
                            </h3>
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>

            <div class="card">
                <div class="card-header">Vender</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card justify-content-center text-center">
                                <table class="table table-sm">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center" scope="col">Producto</th>
                                            <th class="text-center" scope="col">Precio</th>
                                            <th class="text-center" scope="col">Cantidad</th>
                                            <th class="text-center" scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productos as $item)
                                        <tr>
                                            <td>{{ $item['producto']->nombre }}</td>
                                            <td>{{ number_format($item['producto']->precio, 0, ",", ".") }}</td>
                                            <td>{{ number_format($item['productos_user']->cantidad, 0, ",", ".") }}</td>
                                            <td>{{ number_format($item['producto']->precio * $item['productos_user']->cantidad, 0, ",", ".") }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-inline row justify-content-center mt-5" style="text-align:right;">
                        <label class="h6 mr-3" style="text-align:right;">Precio total</label>
                        <label class="h5 mr-5" style="text-align:right;"><strong>$ {{ number_format($precioTotal, 0, ",", ".") }}</strong></label>
                    </div>
                    <form method="POST" action="{{ route('vender.store2', $venta) }}">
                        @csrf

                        <input id="precio_total" type="number" class="col-md-2 form-control text-md-left" name="precio_total" value="{{ $precioTotal }}" style="display:none" />
                        <input id="venta_id" type="text" class="col-md-2 form-control text-md-left" name="venta_id" value="{{ $venta->id }}" style="display:none" />
                        
                        <div class="form-inline row mt-5 offset-md-3">
                            <label class="col-md-2 col-form-label text-md-right">Tipo de venta</label>
                            <div class="col-md-4">
                                <select id="tipo_venta" class="form-control" name="tipo_venta">
                                    <option value="presencial">Presencial</option>
                                    <option value="telefonica" selected>Telefónica</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-inline row mt-3 offset-md-3 mb-5">
                            <label for="unidad_medida" class="col-md-2 col-form-label text-md-right">Medio de pago</label>
                            <div class="col-md-4">
                                <select id="medio_pago" class="form-control" name="medio_pago">
                                    <option value="efectivo" selected>Efectivo</option>
                                    <option value="debito">Débito</option>
                                    <option value="credito">Crédito</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mt-5 mb-5 mt-5">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    Finalizar
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @endsection