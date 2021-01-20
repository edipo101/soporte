@extends('layouts.auth')

@section('title')
    GENERACION DE TICKET'S - SOPORTE TECNICO
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('fonts/fonts-soporte/style.css') }}">
@endsection

@section('content')
<body class="hold-transition register-page">
<div class="register-box-ticket">
  <div class="register-logo">
  	<img src="{{ asset('/img/logo.jpg') }}" class="img-responsive center-block" width="50px">
  	SOPORTE TECNICO
  </div>
{!! Form::open(['route' => 'home.storeticket']) !!}
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right">
      <li class=""><a href="#tab_3-2" data-toggle="tab" aria-expanded="false">SERVICIOS</a></li>
      <li class="pull-left header"><i class="fa fa-tag"></i> GENERACION DE TICKET</li>
      <li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">COMPONENTE</a></li>
      <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="true">DATOS</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_1-1">
      	{{ Form::hidden('nticket',$nticket) }}
        @if($tip=="gams")
        <div class="form-group has-feedback{{ $errors->has('solicitante') ? ' has-error' : '' }}">
            <input type="text" class="form-control text-uppercase" placeholder="Nombre Completo" name="solicitante" value="{{ old('solicitante') }}"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->has('solicitante'))
                <span class="help-block">
                    <strong>{{ $errors->first('solicitante') }}</strong>
                </span>
            @endif
        </div>
        @elseif($tip=="empresa")
        <div class="form-group has-feedback{{ $errors->has('empresa') ? ' has-error' : '' }}">
            <input type="text" class="form-control text-uppercase" placeholder="Nombre de la Empresa" name="empresa" value="{{ old('empresa') }}"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->has('empresa'))
                <span class="help-block">
                    <strong>{{ $errors->first('empresa') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group text-center">
          <h5 class="lead">SE ENTREGO LO SIGUIENTE</h5>
          <label>
            {{ Form::checkbox('factura','E',null,['class'=>"radio"]) }} FACTURA
          </label>
          <label>
            {{ Form::checkbox('ordencompra','E',null,['class'=>"radio"]) }} ORDEN DE COMPRA   
          </label>
          <label>
            {{ Form::checkbox('garantia','E',null,['class'=>"radio"]) }} GARANTIA   
          </label>
        </div>
        @endif
        <div class="form-group has-feedback{{ $errors->has('unidad') ? ' has-error' : '' }}">
            <input type="text" autocomplete="off" class="form-control text-uppercase" placeholder="Unidad" name="unidad" id="unidad" value="{{ old('unidad') }}"/>
            <span class="glyphicon glyphicon-tasks form-control-feedback"></span>
            @if ($errors->has('unidad'))
                <span class="help-block">
                    <strong>{{ $errors->first('unidad') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback{{ $errors->has('telef_referencia') ? ' has-error' : '' }}">
            <input type="text" id="telef_referencia" class="form-control" placeholder="TELEFONO DE REFERENCIA" name="telef_referencia" value="{{ old('telef_referencia') }}"/>
            <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
            @if ($errors->has('telef_referencia'))
                <span class="help-block">
                    <strong>{{ $errors->first('telef_referencia') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback{{ $errors->has('celular_referencia') ? ' has-error' : '' }}">
            <input type="text" id="celular_referencia" class="form-control" placeholder="CELULAR" name="celular_referencia" value="{{ old('celular_referencia') }}"/>
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            @if ($errors->has('celular_referencia'))
                <span class="help-block">
                    <strong>{{ $errors->first('celular_referencia') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
			<a href="#tab_2-2" aria-controls="tab_2-2" role="tab" data-toggle="tab" class="btn btn-info">Siguiente</a>
      <a href="{{ url('/invitado') }}" class="btn btn-danger">Cancelar</a>
		</div>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_2-2">
        <h4>LISTA DE COMPONENTES DEL AREA DE SOPORTE TECNICO</h4>
        <div class="componentes">
            @foreach($componentes as $componente)
                <input type="radio" name="componente_id" value={{ $componente->id }} id="comp{{ $componente->id }}" class="radio-boton">
                {{-- {{ Form::radio('componente_id',$componente->id,['id'=>'comp']) }} --}}
                <label class="item" for="comp{{ $componente->id }}">
                    <span class="icon icon-{{ $componente->icono }}"></span> {{ strtoupper($componente->nombre) }}
                </label>
            @endforeach
        </div>
        <hr>
      	<div class="form-group">
			<a href="#tab_1-1" aria-controls="tab_1-1" role="tab" data-toggle="tab" class="btn btn-default">Anterior</a>
			<a href="#tab_3-2" aria-controls="tab_3-2" role="tab" data-toggle="tab" class="btn btn-info">Siguiente</a>
		</div>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_3-2">
        <div class="form-group">
			@foreach($diagnosticos as $diagnostico)
				<div class="checkbox icheck">
		            <label>
		                {{ Form::checkbox('diagnosticos[]', $diagnostico->id,null,['class'=>'radio']) }}
		                <strong>{{ $diagnostico->nombre }}</strong> <em>({{ $diagnostico->descripcion }})</em>
		            </label>
		        </div>
			@endforeach
		</div>
		<div class="form-group">
			{{ Form::label('observacion', 'Observacion') }}
			{{ Form::textarea('observacion',null,['class'=> 'form-control text-uppercase', 'rows' => '3']) }}
		</div>
		<div class="form-group">
			<a href="#tab_2-2" aria-controls="tab_2-2" role="tab" data-toggle="tab" class="btn btn-default">Anterior</a>
			{{ Form::submit('Guardar', ['class'=>'btn btn-primary']) }}
		</div>
      </div>
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  {!! Form::close() !!}
  </div>
@include('layouts.partials.scripts-auth')
<!-- InputMask -->
<script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('plugins/bootstrap3-typeahead/bootstrap3-typeahead.js') }}" type="text/javascript"></script>
<script>
    $(function () {
        $('input.radio').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
        $('#celular_referencia').inputmask('99999999');
    	$('#telef_referencia').inputmask('64-99999');
    	var route_unidades = "{{ route('unidads.getUnidads') }}";
		$.get(route_unidades, function(data){
		  $("#unidad").typeahead({
		  	source:data,
		  	displayText: function(data){ return data.nombre;},
		  });
		},'json');
    });
</script>
</body>

@endsection