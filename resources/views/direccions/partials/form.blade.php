<div class="form-group{{ $errors->has('funcionario') ? ' has-error' : '' }}">
	{{ Form::label('funcionario', 'Funcionario') }}
	{{ Form::text('funcionario',null,['class'=> 'form-control text-uppercase','placeholder'=>'NOMBRE DEL FUNCIONARIO']) }}
	@if ($errors->has('funcionario'))
        <span class="help-block">
            <strong>{{ $errors->first('funcionario') }}</strong>
        </span>
    @endif
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
			{{ Form::label('cargo', 'Cargo') }}
			{{ Form::text('cargo',null,['class'=> 'form-control text-uppercase','placeholder'=>'CARGO DEL FUNCIONARIO']) }}
			@if ($errors->has('cargo'))
				<span class="help-block">
					<strong>{{ $errors->first('cargo') }}</strong>
				</span>
			@endif
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group{{ $errors->has('unidad') ? ' has-error' : '' }}">
			{{ Form::label('unidad', 'UNIDAD') }}
			{{ Form::text('unidad',null,['class'=> 'form-control text-uppercase','placeholder'=>'UNIDAD DEL FUNCIONARIO']) }}
			@if ($errors->has('unidad'))
				<span class="help-block">
					<strong>{{ $errors->first('unidad') }}</strong>
				</span>
			@endif
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group{{ $errors->has('ipv4') ? ' has-error' : '' }}">
			{{ Form::label('ipv4', 'Direccion IP') }}
			<div class="input-group">
				<div class="input-group-addon">
				<i class="fa fa-laptop"></i>
				</div>
				{{ Form::text('ipv4',null,['class'=> 'form-control ipmask','placeholder'=>'192.168.0.0']) }}
			</div>
			@if ($errors->has('ipv4'))
				<span class="help-block">
					<strong>{{ $errors->first('ipv4') }}</strong>
				</span>
			@endif
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group{{ $errors->has('mac') ? ' has-error' : '' }}">
			{{ Form::label('mac', 'MAC del Equipo') }}
			<div class="input-group">
				<div class="input-group-addon">
				<i class="fa fa-laptop"></i>
				</div>
				{{ Form::text('mac',null,['class'=> 'form-control macmask','placeholder'=>'D0:BC:98:8B:83:4D']) }}
			</div>
			@if ($errors->has('mac'))
				<span class="help-block">
					<strong>{{ $errors->first('mac') }}</strong>
				</span>
			@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group{{ $errors->has('nombrepc') ? ' has-error' : '' }}">
			{{ Form::label('nombrepc', 'Nombre del Equipo') }}
			{{ Form::text('nombrepc',null,['class'=> 'form-control','placeholder'=>'NOMBRE USUARIO DEL EQUIPO']) }}
			@if ($errors->has('nombrepc'))
				<span class="help-block">
					<strong>{{ $errors->first('nombrepc') }}</strong>
				</span>
			@endif
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group{{ $errors->has('redimpresora') ? ' has-error' : '' }}">
			{{ Form::label('redimpresora', 'Red de la Impresora') }}
			<div class="input-group">
				<div class="input-group-addon">
				<i class="fa fa-print"></i>
				</div>
				{{ Form::text('redimpresora',null,['class'=> 'form-control ipmask','placeholder'=>'192.168.0.1']) }}
			</div>
			@if ($errors->has('redimpresora'))
				<span class="help-block">
					<strong>{{ $errors->first('redimpresora') }}</strong>
				</span>
			@endif
		</div>
	</div>
</div>

<hr>
<h4 class="text-center">SERVICIOS</h4>
<div class="form-group container text-center">
	<div class="checkbox icheck enlinea">
		<label>
			{{ Form::checkbox('internet') }}
			<strong>INTERNET</strong>
		</label>
	</div>
	<div class="checkbox icheck enlinea">
		<label>
			{{ Form::checkbox('sigma') }}
			<strong>SIGMA</strong>
		</label>
	</div>
	<div class="checkbox icheck enlinea">
		<label>
			{{ Form::checkbox('sigep') }}
			<strong>SIGEP</strong>
		</label>
	</div>
</div>
<hr>

<div class="form-group text-center">
	{{ Form::submit('GUARDAR', ['class'=>'btn btn-flat btn-primary']) }}
	<a href="{{ route('direccions.index') }}" class="btn btn-flat btn-danger">CANCELAR</a>
</div>

@section('scripts')
<!-- iCheck -->
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
<!-- InputMask -->
<script src="{{ asset('plugins/jquery-mask/jquery.mask.js') }}"></script>
<script>
    $(function(){
        // Script para personalizar los checkbutton del formulario
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
		});
		// Script para colocar tipo de mascara a los ips
		$('.ipmask').mask('099.099.099.099', {placeholder: "___.___.___.___"});
		// Script para colocar tipo de mascara a la mac
		$('.macmask').mask('AA:AA:AA:AA:AA:AA', {placeholder: "__:__:__:__:__:__"});
    });
</script>
@endsection