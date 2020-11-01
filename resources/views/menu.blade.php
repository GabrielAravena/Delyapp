@extends('layouts.dashboard')
@section('content')
<div class="main-content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">

        <!-- Header -->
        <div class="header mt-5">
          <div class="header-body">
            <div class="row align-items-center">
              <div class="col">

                <!-- Title -->
                <h3 class="header-title">
                  Productos en venta
                </h3>
              </div>
            </div>
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
                      <th style="text-align:center" scope="col">Descripción</th>
                      <th style="text-align:center" scope="col">Imagen</th>
                      <th style="text-align:center" scope="col">Precio</th>
                      <th style="text-align:center" scope="col">Activar/Desactivar</th>
                      <th style="text-align:center" scope="col">Eliminar</th>
                    </tr>
                  </thead>
                  @foreach($productos as $producto)
                  <tbody>
                    <tr>
                      <td>{{$producto->nombre}}</td>
                      <td class="col-md-6">{{$producto->descripcion}}</td>
                      <td style="text-align:center">{{$producto->imagen}}</td>
                      <td style="text-align:center">{{$producto->precio}}</td>
                      <td class="col-md-4" style="text-align:center">
                        @if($producto->estado == 'activado')
                        <a href="{{ route('menu.desactivar', $producto)}}" class="btn btn-success btn-sm"> {{$producto->estado}} </a>
                        @else
                        <a href="{{ route('menu.activar', $producto)}}" class="btn btn-secondary btn-sm"> {{$producto->estado}} </a>
                        @endif
                      </td>
                      <td class="col-md-2" style="text-align:center">
                        <a href="{{ route('menu.delete', $producto) }}" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro que deseas eliminar este producto? \n\n'+
                                            'Al eliminar un ingrediente, se eliminarán todos los registros de este.\n\n'+ 
                                            'ESTA INFORMACIÓN NO SE PUEDE RECUPERAR.');">Eliminar</a>
                        <label style="display:none" value="{{$producto->id}}"></label>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- <a href="{{ route('menu.create')}}" class="btn btn-primary btn-sm">Nuevo producto</a> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3" style="float:right" >
          <a href="{{ route('menu.create')}}" class="btn btn-primary btn-sm">Nuevo producto</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection