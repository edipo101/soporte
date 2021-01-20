@extends('layouts.auth')

@section('title')
    GENERACION DE TICKET'S - SOPORTE TECNICO
@endsection

@section('content')
<body class="hold-transition login-page">
  <div class="login-box">
      <div class="login-logo">
        <img src="{{ asset('/img/logo.jpg') }}" class="img-responsive center-block" width="50px">
        SOPORTE TECNICO
      </div><!-- /.login-logo -->
    <div class="login-box-body">
    <p class="login-box-msg"> Ticket Generado: {{ $ticket->nro_ticket."/".$ticket->gestion }} </p>
    <div class="text-center">
      <a href="javascript:void(0);" onclick="imprimirTicket({{ $ticket->id }});return false;" class="btn btn-app">
        <i class="fa fa-print"></i> Imprimir Ticket
      </a>
    </div>
    <div class="text-center">
      <a href="{{ url('/invitado') }}" class="btn btn-link">
        <i class="fa fa-tag"></i> Generar Nuevo Ticket
      </a>
    </div>
    
    </div><!-- /.login-box-body -->
    <div class="box-footer">
      <span class="text-center help-block" style="font-size: 0.75em">Gobierno Autonomo  Municipal de Sucre - <strong>{{Carbon\Carbon::now()->year}}</strong></span>
    </div>
  </div><!-- /.login-box -->
  @include('invitado.imprimir.imprimir-modal')
  @include('layouts.partials.scripts-auth')
  <script src="{{ asset('js/script.js') }}"></script>
  <script>
    let imprimirTicket = id => {
      let ruta = `${direccion}/generar/${id}/imprimir`
      imprimir(ruta)
    }
    </script>
</body>
@endsection