@extends('layouts.dashboard')
@section('content')
<div class="main-content">
  <div class="container" id="container">
    <div class="row justify-content-center">
      <div class="col-12">

        <!-- Header -->
        <div class="header mt-5 mb-3">
          <div class="header-body">
            <div class="row align-items-center">
              <div class="col">

                <!-- Title -->
                <h3 class="header-title">
                  Productos en venta
                </h3>
                @if(session('mensaje'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Perfecto:</strong> {{ session('mensaje') }}
                  <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                    <span>&times;</span>
                  </button>
                </div>
                @endif
                @if(session('sinProductos'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>{{ session('sinProductos') }}</strong>
                  <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                    <span>&times;</span>
                  </button>
                </div>
                @endif
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
                      <th style="text-align:center" scope="col">Precio sugerido</th>
                      <th style="text-align:center" scope="col">Activar/ Desactivar</th>
                      <th style="text-align:center" scope="col">Modificar</th>
                      <th style="text-align:center" scope="col">Eliminar</th>
                    </tr>
                  </thead>
                  @foreach($productos as $producto)
                  <tbody>
                    <tr>
                      <td style="vertical-align: middle">{{ $producto->nombre }}</td>
                      <td style="vertical-align: middle">{{ $producto->descripcion }}</td>
                      <td style="text-align:center">
                        @if($producto->imagen)
                          <img src="{{ asset($producto->imagen) }}" alt="Imagen producto" width="150px" height="80px" />
                        @else
                          <img src="{{ asset('/images/sinImagen.jpeg') }}" alt="Imagen producto" width="150px" height="80px" />
                        @endif
                        </td>
                      <td style="text-align:right; vertical-align: middle"><strong>{{ number_format($producto->precio, 0, ",", ".") }}</strong></td>
                      <td style="text-align:right; vertical-align: middle">{{ number_format($producto->precio_sugerido, 0, ",", ".") }}</td>
                      <td style="text-align:center; vertical-align: middle">
                        @if($producto->estado == 'activado')
                        <a href="{{ route('menu.activar', $producto)}}">
                          <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-check2-square" fill="green" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                            <path fill-rule="evenodd" d="M1.5 13A1.5 1.5 0 0 0 3 14.5h10a1.5 1.5 0 0 0 1.5-1.5V8a.5.5 0 0 0-1 0v5a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V3a.5.5 0 0 1 .5-.5h8a.5.5 0 0 0 0-1H3A1.5 1.5 0 0 0 1.5 3v10z" />
                          </svg>
                        </a>
                        @else
                        <a href="{{ route('menu.activar', $producto)}}">
                          <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-x-square" fill="red" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                            <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                          </svg>
                        </a>
                        @endif
                      </td>
                      <td style="text-align:center; vertical-align: middle">
                        <a href="{{ route('menu.modificar', $producto) }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="green" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                          </svg>
                        </a>
                      </td>
                      <td style="text-align:center; vertical-align: middle">
                        <a href="{{ route('menu.delete', $producto) }}" onclick="return confirm('¿Estás seguro que deseas eliminar este producto? \n\n'+
                                            'Al eliminar un producto, se eliminarán todos los registros de este.\n\n'+ 
                                            'ESTA INFORMACIÓN NO SE PUEDE RECUPERAR.');">
                          <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash" fill="red" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                          </svg>
                        </a>
                        <label style="display:none" value="{{$producto->id}}"></label>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-5" style="float:right">
          <a href="{{ route('menu.create')}}" class="btn btn-green btn-sm">Nuevo producto</a>
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
@endsection