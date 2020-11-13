@extends('layouts.dashboard')
@section('content')

<div class="container" style="margin-top: 50px;">
  <div class="row justify-content-center">
    <div class="col-sm-4">
      <div class="card shadow">
        <div class="card-body">
          <h5 class="card-title">Ingresos del día</h5>
          <p class="card-text h4">${{ number_format($ventasDia, 0, ",", ".") }}</p>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card shadow" onclick="mostrarSemana()">
        <div class="card-body">
          <h5 class="card-title">Ingresos de la semana</h5>
          <p class="card-text h4">${{ number_format($infoSemana->ventasSemana, 0, ",", ".") }}</p>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card shadow" onclick="mostrarMes()">
        <div class="card-body">
          <h5 class="card-title">Ingresos del mes</h5>
          <p class="card-text h4">${{ number_format($infoMes->ventasMes, 0, ",", ".") }}</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container" style="margin-top: 50px;">
    <canvas class="my-4 mr-5 w-100 shadow" id="grafico_mes" style="display: none" width="900" height="380"></canvas>
    <canvas class="my-4 mr-5 w-100 shadow" id="grafico_semana" style="display: block" width="900" height="380"></canvas>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

<script>

  function mostrarSemana() {
    document.getElementById('grafico_semana').style.display = 'block';
    document.getElementById('grafico_mes').style.display = 'none';
  }

  function mostrarMes(){
    document.getElementById('grafico_semana').style.display = 'none';
    document.getElementById('grafico_mes').style.display = 'block';
  }

  function ocultar() {
    document.getElementById('precio').style.display = 'none';
    $('#precio').removeAttr("required");
  }
  var ctx = document.getElementById('grafico_mes').getContext('2d');
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: @json($infoMes -> diasMesActual),
      datasets: [{
        label: 'Ventas del mes',
        data: @json($infoMes -> ventasMesPorDia),
        backgroundColor: [
          'rgba(255, 99, 132, 0)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
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
            labelString: 'Valor ventas diarias'
          },
          ticks: {
            beginAtZero: true
          }
        }],
        xAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'Días del mes'
          },
          ticks: {
            beginAtZero: true
          }
        }],
      }
    }
  });

  var ctx = document.getElementById('grafico_semana').getContext('2d');
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
      datasets: [{
        label: 'Ventas de la semana',
        data: @json($infoSemana -> ventasSemanaPorDia),
        backgroundColor: [
          'rgba(255, 99, 132, 0)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
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
            labelString: 'Valor ventas diarias'
          },
          ticks: {
            beginAtZero: true
          }
        }],
        xAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'Días de la semana'
          },
          ticks: {
            beginAtZero: true
          }
        }],
      }
    }
  });
</script>

@endsection