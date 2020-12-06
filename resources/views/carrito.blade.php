@extends('layouts.app')
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
                Carrito de compras
              </h3>
            </div>
          </div> <!-- / .row -->
        </div>
      </div>

      <div class="card">
        @if($productos)
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="card justify-content-center text-center">

                <table class="table table-sm">
                  <thead>
                    <tr class="text-center">
                      <th class="text-center" scope="col">Producto</th>
                      <th class="text-center" scope="col">Cantidad</th>
                      <th class="text-right" scope="col">Precio unitario</th>
                      <th class="text-right" scope="col">Total</th>
                      <th class="text-center" scope="col">Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($productos as $producto)
                    <tr>
                      <td>{{ $producto->nombre }}</td>
                      <td>{{ $producto->cantidad }}</td>
                      <td style="text-align:right">{{ number_format($producto->precio, 0, ",", ".") }}</td>
                      <td style="text-align:right">{{ number_format($producto->precio * $producto->cantidad, 0, ",", ".") }}</td>
                      <td style="text-align:center">
                        <a href="{{ route('carrito.delete', $producto->id) }}">
                          <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="red" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                          </svg>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="form-inline row justify-content-center mt-5" style="text-align:right;">
            <label class="h6 mr-3" style="text-align:right;">Precio total</label>
            <label class="h5 mr-5" style="text-align:right;"><strong></strong>${{ number_format($producto->total, 0, ",", ".") }}</label>
          </div>
          <div class="form-inline row justify-content-center mt-5 mb-5 mt-5">
            <div>
              <a class="btn btn-green text-white">
                Pagar
              </a>
              <a class="btn btn-primary text-white" href="{{ route('local.index', $producto->local_id) }}">
                Seguir comprando
              </a>
            </div>
          </div>
        </div>
      </div>
      @else
      <h4 class="mt-5 mb-5 ml-5">Oops... Tu carrito está vacío.</h4>
      <a href="{{ route('inicio') }}" class="btn btn-primary mt-5 mb-5">volver</a>
      @endif
    </div>
  </div>
  @endsection