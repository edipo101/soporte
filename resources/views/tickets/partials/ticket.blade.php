@if(isset($tickets))
<div class="container-fluid">
	<div id="unidadticket" class="datosunidad row hidden" style="border: 1px #ccc solid; padding: 0 20px">
		<br>
		<p class="lead pull-left">DATOS DEL TICKET</p>
		<button type="button" id="editar-ticket" class=" pull-right btn btn-default btn-flat"><i class="fa fa-edit"></i></button>
		<br>
		<hr>
		<div class="col-md-4 form-group{{ $errors->has('solicitante') ? ' has-error' : '' }}">
			{{ Form::label('solicitante', 'Solicitud por') }}
			{{ Form::text('solicitante',null,['class'=> 'form-control text-uppercase', 'id'=>'tsolicitud', 'disabled']) }}
			@if ($errors->has('solicitante'))
		        <span class="help-block">
		            <strong>{{ $errors->first('solicitante') }}</strong>
		        </span>
		    @endif
		</div>
		<div class="col-md-4 form-group{{ $errors->has('unidad_id') ? ' has-error' : '' }}">
			{{ Form::label('unidad_id', 'Unidad') }}
			{{ Form::select('unidad_id', $unidades,null,['class'=> 'form-control', 'id'=>'unidad_id', 'disabled']) }}
			@if ($errors->has('unidad_id'))
		        <span class="help-block">
		            <strong>{{ $errors->first('unidad_id') }}</strong>
		        </span>
		    @endif
		</div>
		<div class="col-md-4 form-group{{ $errors->has('componente_id') ? ' has-error' : '' }}">
			{{ Form::label('componente_id', 'Componente') }}
			{{ Form::select('componente_id',$componentes,null,['class'=> 'form-control', 'id'=>'componente_id', 'disabled']) }}
			@if ($errors->has('componente_id'))
		        <span class="help-block">
		            <strong>{{ $errors->first('componente_id') }}</strong>
		        </span>
		    @endif
		</div>
		<div class="col-md-12 form-group{{ $errors->has('observacion') ? ' has-error' : '' }}">
			{{ Form::label('observacion', 'Observacion') }}
			{{ Form::textarea('observacion',null,['class'=> 'form-control text-uppercase', 'id'=>'tobservacion','rows' =>'2', 'disabled']) }}
			@if ($errors->has('observacion'))
		        <span class="help-block">
		            <strong>{{ $errors->first('observacion') }}</strong>
		        </span>
		    @endif
		</div>
	</div>
</div>
@elseif(isset($ticket))
<div class="container-fluid">
	<div id="unidadticket" class="datosunidad row" style="border: 1px #ccc solid; padding: 0 20px">
		<br>
		<p class="lead pull-left">DATOS DEL TICKET</p>
		<button type="button" id="editar-ticket" class=" pull-right btn btn-default btn-flat"><i class="fa fa-edit"></i></button>
		<br>
		<hr>
		<div class="col-md-4 form-group{{ $errors->has('solicitante') ? ' has-error' : '' }}">
			{{ Form::label('solicitante', 'Solicitud por') }}
			{{ Form::text('solicitante',$ticket->solicitante,['class'=> 'form-control text-uppercase', 'id' => 'tsolicitud','disabled']) }}
			@if ($errors->has('solicitante'))
		        <span class="help-block">
		            <strong>{{ $errors->first('solicitante') }}</strong>
		        </span>
		    @endif
		</div>
		<div class="col-md-4 form-group{{ $errors->has('unidad_id') ? ' has-error' : '' }}">
			{{ Form::label('unidad_id', 'Unidad') }}
			{{ Form::select('unidad_id', $unidades,$ticket->unidad->id,['class'=> 'form-control', 'disabled','id'=>'unidad_id']) }}
			@if ($errors->has('unidad_id'))
		        <span class="help-block">
		            <strong>{{ $errors->first('unidad_id') }}</strong>
		        </span>
		    @endif
		</div>
		<div class="col-md-4 form-group{{ $errors->has('componente_id') ? ' has-error' : '' }}">
			{{ Form::label('componente_id', 'Componente') }}
			{{ Form::select('componente_id',$componentes,$ticket->componente->id,['class'=> 'form-control', 'id'=>'componente_id', 'disabled']) }}
			@if ($errors->has('componente_id'))
		        <span class="help-block">
		            <strong>{{ $errors->first('componente_id') }}</strong>
		        </span>
		    @endif
		</div>
		<div class="col-md-12 form-group{{ $errors->has('observacion') ? ' has-error' : '' }}">
			{{ Form::label('observacion', 'Observacion') }}
			{{ Form::textarea('observacion',$ticket->observacion=="" ? "Sin Observacion": $ticket->observacion ,['class'=> 'form-control','rows' =>'2', 'id' => 'tobservacion', 'disabled']) }}
			@if ($errors->has('observacion'))
		        <span class="help-block">
		            <strong>{{ $errors->first('observacion') }}</strong>
		        </span>
		    @endif
		</div>
	</div>
</div>
@endif