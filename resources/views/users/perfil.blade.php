@extends('layouts.app')

@section('title')
    Perfil
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-user"></i>
		PERFIL
		<small>Perfil del usuario activo</small>
	</h1>
@endsection

@section('main-content')
<div class="row">
	<div class="col-md-4">
		<div class="box box-default">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('img/users/'.$tecnico->foto) }}" alt="{{ str_slug($tecnico->fullnombre) }}">

              <h3 class="profile-username text-center">{{ $tecnico->fullnombre }}</h3>

              <p class="text-muted text-center">{{ $user->nickname }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Documento de Identidad</b> <a class="pull-right">{{ $tecnico->carnet }}</a>
                </li>
                <li class="list-group-item">
                  <b>Cargo</b> <a class="pull-right">{{ $tecnico->cargo }}</a>
                </li>
                <li class="list-group-item">
                  <b>Roles</b> <a class="pull-right">
                  	@foreach($user->roles as $roles)
                  		<span class="label label-primary"> {{ $roles->name }}</span>
                  	@endforeach
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
	</div>
	<div class="col-md-8">
		<div class="box box-default">
			<div class="box-header with-border">
			 	<h3 class="box-title"><i class="fa fa-lock"></i> CAMBIO DE CONTRASEÑA</h3>
			 	<div class="box-tools pull-right">
			 		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
			      		<i class="fa fa-minus"></i>
			      	</button>
			    	<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
			      		<i class="fa fa-times"></i>
			      	</button>
			  	</div>
			</div>
            {!! Form::open(['route' => ['users.updatepassword', $user->id], 'method' => 'PUT']) !!}
            <div class="box-body">
            	<br><br>
				<div class="form-group">
					{{ Form::label('password', 'Contraseña') }}
					{{ Form::password('password',['class'=> 'form-control','placeholder'=>'*******']) }}
				</div>
				<br>
				<div class="form-group">
					{{ Form::label('password-confirm', 'Repetir contraseña') }}
					{{ Form::password('password_confirmation',['class'=> 'form-control','placeholder'=>'*******']) }}
				</div>
			</div>
            <!-- /.box-body -->
			<div class="box-footer">
				<div class="form-group text-center">
					{{ Form::submit('CAMBIAR CONTRASEÑA', ['class'=>'btn btn-flat btn-md btn-success']) }}
					<a href="{{ url('/home') }}" class="btn btn-flat btn-danger">CANCELAR</a>
				</div>
            </div>
			{!! Form::close() !!}
          </div>
	</div>
</div>

@endsection