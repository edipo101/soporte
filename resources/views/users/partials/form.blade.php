@if(isset($tecnico))
<input type="hidden" id="fotografia" name="fotografia" value="{{ asset('img/users/'.$tecnico->foto) }}"/>
<input type="hidden" id="id_user" name="id_user" value="{{ $tecnico->id }}"/>
@else
<input type="hidden" id="fotografia" name="fotografia" value=""/>
@endif
<div class="form-group{{ $errors->has('carnet') ? ' has-error' : '' }}">
	{{ Form::label('carnet', 'Documento de Identidad') }}
	{{ Form::text('carnet',null,['class'=> 'form-control','placeholder'=>'000000']) }}
	@if ($errors->has('carnet'))
        <span class="help-block">
            <strong>{{ $errors->first('carnet') }}</strong>
        </span>
    @endif
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
			{{ Form::label('nombre', 'Nombre') }}
			{{ Form::text('nombre',null,['class'=> 'form-control text-uppercase','placeholder'=>'NOMBRE DEL TECNICO']) }}
			@if ($errors->has('nombre'))
		        <span class="help-block">
		            <strong>{{ $errors->first('nombre') }}</strong>
		        </span>
		    @endif
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group{{ $errors->has('apellidos') ? ' has-error' : '' }}">
			{{ Form::label('apellidos', 'Apellidos') }}
			{{ Form::text('apellidos',null,['class'=> 'form-control text-uppercase','placeholder'=>'APELLIDOS DEL TECNICO']) }}
			@if ($errors->has('apellidos'))
		        <span class="help-block">
		            <strong>{{ $errors->first('apellidos') }}</strong>
		        </span>
		    @endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
			{{ Form::label('titulo', 'Profesion') }}
			{{ Form::select('titulo',['Tec.'=>'Tecnico','Prof.'=>'Profesional','Ing.'=>'Ingeniero'],null,['class'=> 'form-control']) }}
			@if ($errors->has('titulo'))
		        <span class="help-block">
		            <strong>{{ $errors->first('titulo') }}</strong>
		        </span>
		    @endif
		</div>
	</div>
	<div class="col-md-8">
		<div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
			{{ Form::label('cargo', 'Cargo') }}
			{{ Form::text('cargo',null,['class'=> 'form-control text-uppercase','placeholder'=>'CARGO DEL TECNICO']) }}
			@if ($errors->has('cargo'))
		        <span class="help-block">
		            <strong>{{ $errors->first('cargo') }}</strong>
		        </span>
		    @endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
			{{ Form::label('nickname', 'Usuario') }}
			{{ Form::text('nickname',isset($tecnico) ? $tecnico->user->nickname : null,['class'=> 'form-control', 'placeholder'=>'NOMBRE DEL USUARIO']) }}
			@if ($errors->has('nickname'))
		        <span class="help-block">
		            <strong>{{ $errors->first('nickname') }}</strong>
		        </span>
		    @endif
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			{{ Form::label('password', 'Contraseña') }}
			{{ Form::password('password',['class'=> 'form-control', 'placeholder'=>'******']) }}
			@if ($errors->has('password'))
		        <span class="help-block">
		            <strong>{{ $errors->first('password') }}</strong>
		        </span>
		    @endif
		</div>
	</div>
</div>

<div class="form-group">
	{{ Form::label('roles','Roles') }}
	{{ Form::select('roles[]',$roles,isset($tecnico) ? $tecnico->user->roles : null,['class'=>'form-control select', 'multiple' => 'multiple']) }}
</div>

<div class="form-group text-center">
	{{ Form::submit('GUARDAR', ['class'=>'btn btn-flat btn-primary']) }}
	<a href="{{ route('users.index') }}" class="btn btn-flat btn-danger">CANCELAR</a>
</div>
