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
                                    Pedidos
                                </h3>
                                @if(session('mensaje'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Perfecto:</strong> {{ session('mensaje') }}
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
                            <div class="card mb-5">

                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center" scope="col" class="col-3">Datos cliente</th>
                                            <th style="text-align:center" scope="col" class="col-4">Productos/Cantidad</th>
                                            <th style="text-align:center" scope="col">Tipo</th>
                                            <th style="text-align:center" scope="col">Precio</th>
                                            <th style="text-align:center" scope="col" class="col-2">Confirmar producto listo/ envío</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($productos as $producto)
                                        <tr>
                                            @if($producto[0]->user_id != 1)
                                            <td>
                                                <ul>
                                                    <li>- Nombre: {{ $producto[0]->user_nombre }}</li>
                                                    <li>- Teléfono: {{ $producto[0]->user_telefono }}</li>
                                                    <li>- Email: {{ $producto[0]->user_email }}</li>
                                                    <li>- Dirección: {{ $producto[0]->user_direccion }}</li>
                                                </ul>
                                            </td>
                                            @else
                                            <td>
                                                <ul>
                                                    <li>- Nombre: {{ $producto[0]->invitado_nombre }}</li>
                                                    <li>- Teléfono: {{ $producto[0]->invitado_telefono }}</li>
                                                    <li>- Email: {{ $producto[0]->invitado_email }}</li>
                                                    <li>- Dirección: {{ $producto[0]->invitado_direccion }}</li>
                                                </ul>
                                            </td>
                                            @endif
                                            <td>
                                                <ul>
                                                    @foreach($producto as $item)
                                                    <li>- {{ $item->producto_nombre }} --------- {{ $item->cantidad }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            @if($producto[0]->delivery)
                                            <td style="vertical-align: middle">Delivery</td>
                                            @else
                                            <td style="vertical-align: middle">Retiro en local</td>
                                            @endif
                                            <td style="text-align:right; vertical-align: middle">{{ number_format($producto[0]->valor, 0, ",", ".") }}</td>
                                            <td style="text-align:center; vertical-align: middle">
                                                <a href="{{ route('pedidos.confirmar', $producto[0]->ventas_id) }}">
                                                    <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-check2-square" fill="green" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                                        <path fill-rule="evenodd" d="M1.5 13A1.5 1.5 0 0 0 3 14.5h10a1.5 1.5 0 0 0 1.5-1.5V8a.5.5 0 0 0-1 0v5a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V3a.5.5 0 0 1 .5-.5h8a.5.5 0 0 0 0-1H3A1.5 1.5 0 0 0 1.5 3v10z" />
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