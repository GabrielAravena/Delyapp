@extends('layouts.dashboard')
@section('content')
<div class="main-content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">

        <!-- Header -->
        <div class="header mt-md-5">
          <div class="header-body">
            <div class="row align-items-center">
              <div class="col">

                <!-- Title -->
                <h3 class="header-title">
                  Ingredientes en bodega
                </h3>
              </div>
            </div> <!-- / .row -->
          </div>
        </div>

        <!-- Team name -->
        <div class="form-group">
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
                      <th style="text-align:center" scope="col">Compra de ingrediente</th>
                      <th style="text-align:center" scope="col">Eliminar producto</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($inventarios as $inventario)
                    <tr>
                      <td>{{$inventario->nombre}}</td>
                      <td style="text-align:center">{{$inventario->cantidad}}</td>
                      <td style="text-align:center">{{$inventario->unidad_medida}}</td>
                      <td style="text-align:center">{{$inventario->valor}}</td>
                      <td style="text-align:center">{{$inventario->pmp}}</td>
                      <td style="text-align:center">
                        <a href="{{ route('inventario.comprar', $inventario) }}">
                          <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="#137830" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                          </svg>
                        </a>
                      </td>
                      <td style="text-align:center">
                        <a href="{{ route('inventario.delete', $inventario) }}" onclick="return confirm('¿Estás seguro que deseas eliminar este ingrediente? \n\n'+
                                              'Al eliminar un ingrediente, se eliminarán todos los registros de este, incluidas las compras que has realizado.\n\n'+ 
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
        <div class="col-md-3" style="float:right">
          <a href="{{ route('inventario.create')}}" class="btn btn-primary btn-sm">Nuevo ingrediente</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection