<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
	{{ Form::label('nombre', 'Nombre') }}
	{{ Form::text('nombre',null,['class'=> 'form-control text-uppercase','placeholder'=>'NOMBRE DEL DIAGNOSTICO']) }}
	@if ($errors->has('nombre'))
        <span class="help-block">
            <strong>{{ $errors->first('nombre') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
	{{ Form::label('descripcion', 'Descripcion') }}
	{{ Form::textarea('descripcion',null,['class'=> 'form-control text-uppercase','rows'=>'4','placeholder'=>'BREVE DESCRIPCION DEL DIAGNOSTICO']) }}
	@if ($errors->has('descripcion'))
        <span class="help-block">
            <strong>{{ $errors->first('descripcion') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
	{{ Form::label('estado', 'Estado') }}
	{{ Form::select('estado',['A'=>'HABILIDADO','D'=>'DESHABILITADO'],null,['class'=> 'form-control']) }}
	@if ($errors->has('estado'))
        <span class="help-block">
            <strong>{{ $errors->first('estado') }}</strong>
        </span>
    @endif
</div>
<div class="form-group text-center">
	{{ Form::submit('GUARDAR', ['class'=>'btn btn-flat btn-primary']) }}
	<a href="{{ route('diagnosticos.index') }}" class="btn btn-flat btn-danger">CANCELAR</a>
</div>