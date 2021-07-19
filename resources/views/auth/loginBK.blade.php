@extends('layouts.auth')

@section('title')
    Inicio de Sesion
@endsection

@section('content')
<body class="hold-transition login-page" style="background-image: url('{{ asset('/img/tecnico.png') }}'); background-repeat: no-repeat;  background-size: 36% 100%; background-position: bottom | left ;">
    <div class="login-box" style="text-align: center;">
        <img src="{{ asset('img/logo_castor.png') }}" alt="CASTOR" style="height: 120px;">
        <div class="login-logo">
            <a href="{{ url('/home') }}">
                <b>CASTOR</b>                
            </a>            
        </div><!-- /.login-logo -->
        <div class="text-center" style="margin-bottom:20px;">
            <small>SOFTWARE DE GESTIÓN DE SOPORTE TECNICO</small>
        </div>            

    <div class="login-box-body">
    <p class="login-box-msg"> Autenticarse para iniciar sesión </p>
    <form action="{{ url('/login') }}" method="post">
        {{ csrf_field() }}

        <div class="form-group has-feedback{{ $errors->has('nickname') ? ' has-error' : '' }}">
            <input type="text" class="form-control" placeholder="Usuario" name="nickname" value="{{ old('nickname') }}"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->has('nickname'))
                <span class="help-block">
                    <strong>{{ $errors->first('nickname') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" class="form-control" placeholder="Contrasena" name="password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember"> Recuerdame
                    </label>
                </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
            </div><!-- /.col -->
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <a href="{{ url('/invitado') }}" class="btn btn-link">GENERAR TICKET</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-right">
                <span><small>Castor v0.0.10 BETA</small></span>                
            </div>
        </div>
    </form>
</div><!-- /.login-box-body -->
<div class="box-footer">
    <span class="text-center help-block" style="font-size: 0.75em">Gobierno Autonomo Municipal de Sucre - <strong>{{Carbon\Carbon::now()->year}}</strong></span>
  </div>
</div><!-- /.login-box -->

@include('layouts.partials.scripts-auth')

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>

@endsection