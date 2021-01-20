<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
	{{ Form::label('nombre', 'Nombre') }}
	{{ Form::text('nombre',null,['class'=> 'form-control text-uppercase', 'placeholder'=>'NOMBRE DEL COMPONENTE']) }}
	@if ($errors->has('nombre'))
        <span class="help-block">
            <strong>{{ $errors->first('nombre') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('icono') ? ' has-error' : '' }}">
	{{ Form::label('icono', 'Icono') }}
	{{ Form::text('icono',null,['class'=> 'form-control', 'placeholder' => 'icono']) }}
	@if ($errors->has('icono'))
        <span class="help-block">
            <strong>{{ $errors->first('icono') }}</strong>
        </span>
    @endif
</div>
<div class="form-group text-center">
	{{ Form::submit('GUARDAR', ['class'=>'btn btn-flat btn-primary']) }}
	<a href="{{ route('componentes.index') }}" class="btn btn-flat btn-danger">CANCELAR</a>
</div>