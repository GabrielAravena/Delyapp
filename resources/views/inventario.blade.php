@extends('layouts.dashboard')
@section('content')
<div class="main-content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <!-- Header -->
        <div class="header mt-5 mb-3">
          <div class="header-body form-inline col-12">
            <!-- Title -->
            <h3 class="header-title">
              Ingredientes en bodega
            </h3>
            <div class="col-sm-7 col-md-7 col-lg-5 justify-content-end" style="display: flex; margin-left: 60px;">
              <a href="{{ route('inventario.realizarInventario') }}" class="btn btn-sm btn-green">Realizar inventario</a>
              <a href="{{ route('gastosFijos.index') }}" class="btn btn-sm btn-primary ml-3">Gastos fijos</a>
            </div>
          </div>
        </div>
        @if(session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Perfecto: </strong> {{ session('mensaje') }}
          <button type="button" class="close" data-dismiss="alert" alert-label="Close">
            <span>&times;</span>
          </button>
        </div>
        @endif
        <!-- Team name -->
        <div class="form-group mb-0">
          <div class="row">
            <div class="col-12">

              <!-- Files -->
              <div class="card">

                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th style="text-align:center" scope="col">Nombre</th>
                      <th style="text-align:center" scope="col">Cantidad</th>
                      <th style="text-align:center" scope="col">Unidad de medida</th>
                      <th style="text-align:center" scope="col">Valorización</th>
                      <th style="text-align:center" scope="col">PMP</th>
                      <th style="text-align:center" scope="col">Último precio</th>
                      <th style="text-align:center" scope="col">Compra de ingrediente</th>
                      <th style="text-align:center" scope="col">Eliminar producto</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($inventarios as $inventario)
                    <tr>
                      <td>{{$inventario->nombre}}</td>
                      <td style="text-align:center">{{ number_format($inventario->cantidad, 0, ",", ".") }}</td>
                      <td style="text-align:center">{{ $inventario->unidad_medida }}</td>
                      <td style="text-align:right">{{ number_format($inventario->valor, 0, ",", ".") }}</td>
                      <td style="text-align:right">{{ number_format($inventario->pmp, 0, ",", ".")}}</td>
                      <td style="text-align:right">{{ number_format($inventario->ultimo_precio, 0 , ",", ".") }}</td>
                      <td style="text-align:center">
                        <a href="{{ route('inventario.comprar', $inventario->id) }}">
                          <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="#137830" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                          </svg>
                        </a>
                      </td>
                      <td style="text-align:center">
                        <a href="{{ route('inventario.delete', $inventario->id) }}" onclick="return confirm('¿Estás seguro que deseas eliminar este ingrediente? \n\n'+
                                              'Al eliminar un ingrediente, se eliminarán todos los registros de este, incluidas las compras que has realizado y LOS PRODUCTOS QUE TENGAN ESTE INGREDIENTE.\n\n'+ 
                                              'ESTA INFORMACIÓN NO SE PUEDE RECUPERAR.');">
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
        </div>
        <div class="col-md-3 mt-3" style="float:left">
          <a href="{{ route('inventario.perdidas') }}" class="btn btn-primary btn-sm">Registro de pérdidas</a>
        </div>
        <div class="col-md-3 mt-3" style="float:right">
          <a href="{{ route('inventario.create', $local_id)}}" class="btn btn-green btn-sm">Nuevo ingrediente</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection