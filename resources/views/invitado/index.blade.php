@extends('layouts.auth')

@section('title')
    GENERACION DE TICKET'S - SOPORTE TECNICO
@endsection

@section('content')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-box-body">
    <img src="{{ asset('/img/logo.jpg') }}" class="img-responsive center-block" width="50px">
    <hr>
    <h3 class="login-box-msg">SOPORTE TECNICO</h3>
    <div class="text-center">
      <p>SELECCIONE UNA DE LAS OPCIONES PARA GENERAR SU TICKET</p>
      <a href="{{ route('home.generar','gams') }}" class="btn btn-app btn-tickets">
        <i class="fa fa-tags"></i> <h3>G.A.M.S.</h3>
      </a>
      <a href="{{ route('home.generar','empresa') }}" class="btn btn-app btn-tickets">
        <i class="fa fa-building"></i> <h3>EMPRESA</h3>
      </a>
    </div>
    <div class="row">
      <div class="col-xs-12 text-center">
        <a href="{{ url('/login') }}" class="btn btn-link">IR AL SISTEMA</a>
      </div>
    </div>
  </div>
  <div class="box-footer">
    <span class="text-center help-block" style="font-size: 0.75em">Gobierno Autonomo Municipal de Sucre - <strong>{{Carbon\Carbon::now()->year}}</strong></span>
  </div>
</div>
</body>

@endsection