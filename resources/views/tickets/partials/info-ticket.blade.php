<div class="row">
	@if(isset($tickets))
	<div class="col-md-4">
		<div class="form-group{{ $errors->has('ticket_id') ? ' has-error' : '' }}">
			{{ Form::label('ticket_id', 'Ticket Nro.') }}
			{{ Form::select('ticket_id',$tickets,null,['class'=> 'form-control select', 'id'=>'ticket_id', 'placeholder'=>'Seleccione el ticket']) }}
			@if ($errors->has('ticket_id'))
		        <span class="help-block">
		            <strong>{{ $errors->first('ticket_id') }}</strong>
		        </span>
		    @endif
		</div>
	</div>
	@elseif(isset($ticket))
	<div class="col-md-4">
		<div class="form-group{{ $errors->has('ticket_id') ? ' has-error' : '' }}">
			{{ Form::label('ticket', 'Ticket Nro.') }}
			{{ Form::text('ticket',$ticket->nro_ticket."/".$ticket->gestion,['class'=> 'form-control', 'id'=>'ticket_id', 'readonly' => 'readonly']) }}
			{{ Form::hidden('ticket_id',$ticket->id) }}
			@if ($errors->has('ticket_id'))
		        <span class="help-block">
		            <strong>{{ $errors->first('ticket_id') }}</strong>
		        </span>
		    @endif
		</div>
	</div>
	@endif
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('fecha', 'Fecha del Informe') }}
			{{ Form::text('fecha',$fecha,['class'=> 'form-control', 'disabled' =>'disabled']) }}
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('usuario', 'Usuario') }}
			{{ Form::text('usuario',$usuario,['class'=> 'form-control', 'disabled' =>'disabled']) }}
		</div>
	</div>
</div>