<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>SOPORTE TECNICO | Inicio de sesión</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">

<!-- Estilos personalizados -->
<link rel="shortcut icon" href="{{ asset('img/logo_castor.png') }}">
<link href="{{ asset('/css/login.css') }}" rel="stylesheet">

<!-- Google Font -->
<link rel="stylesheet" href="{{ asset('fonts/SourceSansPro/fonts.css') }}">

</head>
	
<body>
    <div class="limiter">
		<div class="container-login100">            
			<div class="wrap-login100">
                <form action="{{ url('/login') }}" method="post" class="login100-form">
                        {{ csrf_field() }}
                    <div class="w-full text-center">
                    <img src="{{ asset('img/logo_castor.png') }}" alt="CASTOR" style="height: 120px;">
                    </div> 
                    <div class="w-full text-center">
                    <a href="{{ url('/home') }}">
                        <span style="font-size: 24px"><b>CASTOR</b></span> v1.0.10 BETA
                    </a>    
                    </div>
                    <div class="w-full text-center" style="margin-bottom: 30px">
                        <small>SOFTWARE DE GESTIÓN DE SOPORTE TECNICO</small>
                    </div>     

					<span class="login100-form-title p-b-34">
						Autenticarse para iniciar sesión
					</span>
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" >
						<input class="input100" type="text" placeholder="USUARIO" name="nickname" value="{{ old('nickname') }}">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" >
						<input class="input100" type="password" placeholder="PASSWORD" name="password">
						<span class="focus-input100"></span>
					</div>
					
                    <div class="wrap-erorr100 form-group has-feedback{{ $errors->has('nickname') ? ' has-error' : '' }}">
                        @if ($errors->has('nickname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nickname') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="wrap-erorr100 has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">                        
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							ENTRAR
						</button>
					</div>					

                    <div class="w-full text-center">
						<a href="{{ url('/invitado') }}" class="btn btn-link">GENERAR TICKET</a> | <a href="javascript:void(0);" onclick="verVideo();return false;" class="btn btn-link">¿Cómo generar un Ticket?</a>
					</div>

					<div class="w-full text-center">					
						<span class="text-center help-block" style="font-size: 0.75em">Gobierno Autonomo Municipal de Sucre - <strong>{{Carbon\Carbon::now()->year}}</strong></span>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('{{ asset('/img/logo.png') }}'); background-size: 60%;"></div>
			</div>
		</div>
	</div>


@include('layouts.partials.scripts-auth')
@include('videomodal')
<script>
    let verVideo = () => {
        $('#modal-tutorial').modal('show');
    }
</script>
</body>

</html>