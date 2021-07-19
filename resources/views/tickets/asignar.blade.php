@extends('layouts.app')

@section('title')
    Tickets
@endsection

@section('head-content')
  <h1>
    <i class="fa fa-tag"></i>
    TICKET
    <small>Asignacion de Ticket a un Usuario</small>
  </h1>
@endsection

@section('main-content')
<div class="row">
  <div class="col-md-5">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-info-circle"></i> INFORMACION DEL TICKET</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <strong><i class="fa fa-tag"></i> NRO. DE TICKET</strong>
              <p class="text-center" >
                <span style="font-weight: bold;">
                  {{ $ticket->nro_ticket }}/{{ $ticket->gestion }}
                </span>                
              </p>
              <hr>
            </div>
            <div class="col-md-6">
              @if($ticket->solicitante!="")
              <strong><i class="fa fa-user"></i> SOLICITANTE</strong>
              <p class="text-center">{{ $ticket->solicitante }}</p>
              <hr>
              @else
              <strong><i class="fa fa-bank"></i> EMPRESA</strong>
              <p class="text-center">{{ $ticket->empresa }}</p>
              <hr>
              @endif
            </div>
            @if($ticket->solicitante=="")
            <div class="col-md-12">
              <strong><i class="fa fa-file-o"></i> SE ENTREGO A SOPORTE TECNICO</strong>
              <p class="text-center">
                {{ $ticket->factura=="E" ? "FACTURA.": "" }} 
                {{ $ticket->ordencompra=="E" ? "ORDEN DE COMPRA.": "" }} 
                {{ $ticket->garantia=="E" ? "GARANTIA.": "" }}
              </p>
            </div>
            @endif
            <div class="col-md-6">
              <strong><i class="fa fa-building"></i> UNIDAD</strong>
              <p class="text-center">{{ $ticket->unidad->nombre }}</p>
              <hr>
            </div>
            <div class="col-md-6">
              <strong><i class="fa fa-cube"></i> COMPONENTE</strong>
              <p class="text-center">{{ $ticket->componente->nombre }}</p>
              <hr>
            </div>
            <hr>
            <div class="col-md-12">
              <strong><i class="fa fa-warning"></i> OBSERVACIONES</strong>
              <p>{{ $ticket->observacion ?  : "SIN OBSERVACION" }}</p>
              <hr>
            </div>
            <div class="col-md-12">
              <strong><i class="fa fa-wrench"></i> DIAGNOSTICO Y/O SERVICIOS</strong>              
                @foreach($ticket->diagnosticos as $diagnostico)
                <div>
                <button type="button" class="btn btn-flat btn-primary" data-toggle="popover" title="{{ $diagnostico->nombre }}" data-content="{{ $diagnostico->descripcion }}" data-placement="bottom">{{ $diagnostico->nombre }}</button>
                </div>
                @endforeach              
            </div>
          </div>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
  <div class="col-md-7">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-mail-forward"></i> ASIGNACION DE TICKET</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
      </div>
      <div class="box-body">
        {!! Form::open(['route' => ['tickets.storeasignar',$ticket]]) !!}
            <div class="form-group">
              {{ Form::hidden('prioridad','normal') }}
{{--               {{ Form::label('prioridad', 'Prioridad') }}
              {{ Form::select('prioridad',['normal'=>'NORMAL','alta'=>'ALTA'],null,['class'=> 'form-control']) }} --}}
            </div>  
            <div class="form-group">
              {{ Form::label('fecha_entrega', 'Fecha de Entrega') }}
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                {{ Form::text('fecha_entrega',$fechasugerida,['class'=> 'form-control pull-rigth date']) }}
              </div>
            </div>
            <h4 class="lead"><i class="fa fa-user-secret"></i> PERSONAL DISPONIBLE</h4>
            
            @if( auth()->user()->isRole('encargado') || auth()->user()->isRole('admin') ) 
            <div class="text-center">
              <div class="users-list clearfix btn-group" data-toggle="buttons">
                @foreach($soporte as $sp)                                
                  @if( tiene_acceso($sp) )
                    <div class="btn btn-users btn-primary">                      
                      {{ Form::radio('tecnico_id',$sp->tecnico->id, false,['required' => 'required']) }}
                      <img src="{{ asset('img/users/'.$sp->tecnico->foto) }}" alt="U">
                      <span class="users-list-name">{{ $sp->tecnico->nombre }}</span> 
                      <span class="users-list-name"><small>{{ getAllRole($sp) }}</small></span> 
                      <h4><span class="label label-success">{{ $sp->tickets->where('estado','A')->count() }}</span></h4>                                  
                    </div>
                  @endif            
                @endforeach
              </div> 
            </div>
            @endif

            <div class="form-group text-center">
              {{ Form::submit('ASIGNAR', ['class'=>'btn btn-flat btn-success']) }}
              <a href="{{ route('tickets.index','recepcionados') }}" class="btn btn-flat btn-danger">CANCELAR</a>
            </div>   
        {!! Form::close() !!}
        </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('plugins/moment/moment.js') }}"></script>
<script src="{{ asset('plugins/moment/locale/es.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript">
$(function () {
    $('.date').datetimepicker({
      format: 'DD-MM-YYYY',
      locale: 'es'
    });
    $('[data-toggle="popover"]').popover();
});
</script>
@endsection
