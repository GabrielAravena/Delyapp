@extends('layouts.app')
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
                      <td>{{$inventario->unidad_medida}}</td>
                      <td style="text-align:center">{{$inventario->valor}}</td>
                      <td style="text-align:center">{{$inventario->pmp}}</td>
                      <td class="col-md-3" style="text-align:center">
                        <a href="{{ route('inventario.comprar', $inventario) }}" class="btn btn-primary btn-sm">Comprar</a>
                      </td>
                      <td class="col-md-3" style="text-align:center">
                        <a href="{{ route('inventario.delete', $inventario) }}" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro que deseas eliminar este ingrediente? \n\n'+
                                              'Al eliminar un ingrediente, se eliminarán todos los registros de este, incluidas las compras que has realizado.\n\n'+ 
                                              'ESTA INFORMACIÓN NO SE PUEDE RECUPERAR.');">Eliminar</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3" style="float:right" >
          <a href="{{ route('inventario.create')}}" class="btn btn-primary btn-sm">Nuevo ingrediente</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection