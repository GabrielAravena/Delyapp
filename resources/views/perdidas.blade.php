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
                            Pérdidas
                        </h3>
                    </div>
                </div>

                <!-- Team name -->
                <div class="form-group mb-0">
                    <div class="row">
                        <div class="col-12">

                            <!-- Files -->
                            <div class="card">

                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center" scope="col"></th>
                                            <th style="text-align:center" scope="col">Fecha</th>
                                            <th style="text-align:center" scope="col">Ver detalles</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($perdidas as $perdida)
                                        <tr>
                                            <td style="text-align:center">Desperdicios registrado en:</td>
                                            <td style="text-align:center">{{ $perdida->created_at }}</td>
                                            <td style="text-align:center">
                                                <a href="{{ route('inventario.detallePerdida', $perdida->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="green" class="bi bi-zoom-in" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                                                        <path d="M10.344 11.742c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1 6.538 6.538 0 0 1-1.398 1.4z" />
                                                        <path fill-rule="evenodd" d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5z" />
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
                <div class="col-md-3 mt-3 text-right" style="float:right">
                    <a href="{{ route('inventario.index') }}" class="btn btn-primary btn-sm">Volver</a>
                </div>
            </div>
            <canvas class="my-4 mr-5 w-100 shadow mt-5 mb-5" id="grafico_año" width="900" height="380"></canvas>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>

  var ctx = document.getElementById('grafico_año').getContext('2d');
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: @json($infoMes -> ultimosDoceMeses),
      datasets: [{
        label: 'Pérdidas de los últimos 12 meses',
        data: @json($infoMes -> perdidasDoceMeses),
        backgroundColor: [
          'rgba(249, 177, 41, 0)',
        ],
        borderColor: [
          '#ec5353',
        ],
        borderWidth: 3,
        lineTension: 0,
      }]
    },
    options: {
      scales: {
        yAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'Valor desperdiciado',
          },
          ticks: {
            beginAtZero: true
          }
        }],
        xAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'Últimos 12 meses',
          },
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
  </script>

@endsection