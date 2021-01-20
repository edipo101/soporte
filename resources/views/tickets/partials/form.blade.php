<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('nro_ticket', 'Ticket Nro.') }}
			{{ Form::text('nro_ticket',$nticket,['class'=> 'form-control', 'readonly' => 'readonly']) }}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('fecha', 'Fecha') }}
			{{ Form::text('fecha',$fecha,['class'=> 'form-control', 'disabled' => 'disabled']) }}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('usuario', 'Usuario') }}
			{{ Form::text('usuario',$usuario,['class'=> 'form-control text-uppercase', 'disabled' => 'disabled']) }}
		</div>
	</div>
</div>

@if($tipo=='gams')
<div class="form-group{{ $errors->has('solicitante') ? ' has-error' : '' }}">
	{{ Form::label('solicitante', 'Solicitud por') }}
	{{ Form::text('solicitante',null,['class'=> 'form-control text-uppercase','placeholder'=>'NOMBRE DEL FUNCIONARIO SOLICITANTE']) }}
	@if ($errors->has('solicitante'))
        <span class="help-block">
            <strong>{{ $errors->first('solicitante') }}</strong>
        </span>
    @endif
</div>
@elseif($tipo=='empresa')
<div class="form-group{{ $errors->has('empresa') ? ' has-error' : '' }}">
	{{ Form::label('empresa', 'Empresa') }}
	{{ Form::text('empresa',null,['class'=> 'form-control text-uppercase','placeholder'=>'NOMBRE DE LA EMPRESA']) }}
	@if ($errors->has('empresa'))
        <span class="help-block">
            <strong>{{ $errors->first('empresa') }}</strong>
        </span>
    @endif
</div>
<div class="form-group container text-center">
	<h5 class="lead">SE ENTREGO LO SIGUIENTE</h5>
	<label>
		{{ Form::checkbox('factura','E') }} FACTURA
	</label>
	<label>
		{{ Form::checkbox('ordencompra','E') }} ORDEN DE COMPRA		
	</label>
	<label>
		{{ Form::checkbox('garantia','E') }} GARANTIA		
	</label>
</div>
@endif

<div class="row">
	<div class="col-md-6">
		<div class="form-group{{ $errors->has('unidad') ? ' has-error' : '' }}">
			{{ Form::label('unidad', 'Unidad') }}
			@if(isset($ticket))
			{{ Form::text('unidad',$ticket->unidad->nombre,['class'=>'form-control text-uppercase', 'id'=>'unidad','autocomplete'=>'off','placeholder'=>'UNIDAD SOLICITANTE']) }}
			@else
			{{ Form::text('unidad',null,['class'=> 'form-control text-uppercase','id' => 'unidad','autocomplete'=>'off','placeholder'=>'UNIDAD SOLICITANTE']) }}
			@endif
			@if ($errors->has('unidad'))
		        <span class="help-block">
		            <strong>{{ $errors->first('unidad') }}</strong>
		        </span>
		    @endif
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group{{ $errors->has('componente') ? ' has-error' : '' }}">
			{{ Form::label('componente', 'Componente') }}
			@if(isset($ticket))
			{{ Form::text('componente',$ticket->componente->nombre,['class'=> 'form-control text-uppercase','id'=>'componente','autocomplete'=>'off','placeholder' => 'NOMBRE DEL COMPONENTE','autocomplete'=>'autocomplete']) }}
			@else
			{{ Form::text('componente',null,['class'=> 'form-control text-uppercase','id'=>'componente','placeholder' => 'NOMBRE DEL COMPONENTE','autocomplete'=>'off']) }}
			@endif
			@if ($errors->has('componente_id'))
		        <span class="help-block">
		            <strong>{{ $errors->first('componente') }}</strong>
		        </span>
		    @endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('telef_referencia', 'Telefono de referencia') }}
			{{ Form::text('telef_referencia',null,['class'=> 'form-control', 'placeholder'=>'64-00000', 'id' => 'telef_referencia']) }}
			<span class="help-block">Telefono referencial de la unidad</span>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group{{ $errors->has('celular_referencia') ? ' has-error' : '' }}">
			{{ Form::label('celular_referencia', 'Celular de referencia') }}
			{{ Form::text('celular_referencia',null,['class'=> 'form-control', 'placeholder'=>'00000000', 'id'=>'celular_referencia']) }}
			<span class="help-block">Celular de contacto</span>
			@if ($errors->has('celular_referencia'))
		        <span class="help-block">
		            <strong>{{ $errors->first('celular_referencia') }}</strong>
		        </span>
		    @endif
		</div>
	</div>
</div>
<hr>
<h4 class="text-center">SERVICIOS Y/O PROBLEMAS EN EL EQUIPO</h4>
<div class="form-group container">
	@foreach($diagnosticos as $diagnostico)
		<div class="checkbox icheck">
            <label>
                {{ Form::checkbox('diagnosticos[]', $diagnostico->id) }}
                <strong>{{ $diagnostico->nombre }}</strong> <em>({{ $diagnostico->descripcion }})</em>
            </label>
        </div>
	@endforeach
</div>
<hr>

<div class="form-group">
	{{ Form::label('observacion', 'Observacion') }}
	{{ Form::textarea('observacion',null,['class'=> 'form-control text-uppercase', 'rows' => '3','placeholder'=>'OBSERVACIONES ADICIONALES']) }}
</div>

<div class="form-group text-center">
	{{ Form::submit('GUARDAR', ['class'=>'btn btn-flat btn-primary']) }}
	<a href="{{ route('tickets.index','recepcionados') }}" class="btn btn-flat btn-danger">CANCELAR</a>
</div>

@section('scripts')
<!-- iCheck -->
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>

<!-- InputMask -->
<script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>

<!-- Autocompletado -->
<script src="{{ asset('plugins/bootstrap3-typeahead/bootstrap3-typeahead.js') }}" type="text/javascript"></script>

<script>
 $(function(){
 	// Script para personalizar los checkbutton del formulario
 	$('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
    // Script para agregar mascara a los inputs para los campos de telefono y celular
    $('#celular_referencia').inputmask('99999999');
    $('#telef_referencia').inputmask('64-99999');
    // Script para colocar al campo unidad como autocompletado
    var route_unidades = "{{ route('unidads.getUnidads') }}";
	$.get(route_unidades, function(data){
	  $("#unidad").typeahead({
	  	source:data,
	  	displayText: function(data){ return data.nombre;},
	  });
	},'json');
	// Script para colocar al campo componente como autocompletado
	var route_componente = "{{ route('componentes.getComponentes') }}";
	$.get(route_componente, function(data){
	  $("#componente").typeahead({
	  	source:data,
	  	displayText: function(data){ return data.nombre;},
	  });
	},'json');
 });
</script>
@endsection