<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
	{{ Form::label('nombre', 'Nombre') }}
	{{ Form::text('nombre',null,['class'=> 'form-control text-uppercase','placeholder'=>'NOMBRE DE LA UNIDAD']) }}
	@if ($errors->has('nombre'))
        <span class="help-block">
            <strong>{{ $errors->first('nombre') }}</strong>
        </span>
    @endif
</div>
<div class="form-group text-center">
	{{ Form::submit('GUARDAR', ['class'=>'btn btn-flat btn-primary']) }}
	<a href="{{ route('unidads.index') }}" class="btn btn-flat btn-danger">CANCELAR</a>
</div>