@extends('layouts.dashboard')
@section('content')

<div class="container" style="margin-top: 50px;">
  <div class="row justify-content-center">
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Ingresos del día</h5>
          <p class="card-text h4">$3000</p>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Ingresos de la semana</h5>
          <p class="card-text h4">$120000</p>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Ingresos del mes</h5>
          <p class="card-text h4">$500000</p>
        </div>
      </div>
    </div>
  </div>
  <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
</div>

@endsection