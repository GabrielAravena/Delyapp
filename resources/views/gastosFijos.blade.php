@extends('layouts.dashboard')
@section('content')
<div class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Header -->
                <div class="header mt-5 mb-3">
                    <div class="header-body col-12">
                        <!-- Title -->
                        <h3 class="header-title">
                            Gastos fijos
                        </h3>
                        @if(session('mensaje'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Perfecto: </strong> {{ session('mensaje') }}
                            <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                                <span>&times;</span>
                            </button>
                        </div>
                        @endif
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
                                            <th style="text-align:center" scope="col">valor</th>
                                            <th style="text-align:center" scope="col">Modificar</th>
                                            <th style="text-align:center" scope="col">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($gastosFijos as $gasto)
                                        <tr>
                                            <td style="text-align:center">{{ $gasto->nombre }}</td>
                                            <td style="text-align:center">{{ number_format($gasto->monto, 0, ",", ".") }}</td>
                                            <td style="text-align:center">
                                                <a href="{{ route('gastosFijos.modificar', $gasto->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="green" class="bi bi-pencil" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td style="text-align:center">
                                                <a href="{{ route('gastosFijos.borrar', $gasto->id) }}">
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
                <div class="form-inline row mt-5 mb-3 mt-5 text-center" style="display: flex;">
                    <a href="{{ route('gastosFijos.create') }}" class="btn btn-green btn-sm mr-3">Nuevo gasto fijo</a>
                    <a href="{{ route('inventario.index') }}" class="btn btn-primary btn-sm">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-inline row mt-5 mb-3 mt-5 text-center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-green">
                                    Confirmar
                                </button>
                                <a href="{{ route('inventario.index') }}" class="btn btn-primary">Volver</a>
                            </div>
                        </div>
@endsection