@extends('layouts.app')

@section('title')
    Usuarios
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-user"></i> 
		USUARIO
		<small>Nuevo Registro</small>
	</h1>
@endsection

@section('main-content')
<div class="row">
	<div class="col-md-3">
		<div class="box">
			<div class="box-header with-border">
			 	<h3 class="box-title"><i class="fa fa-image"></i> Fotografia del Usuario</h3>
			</div>
			@include('users.partials.upload')
		</div>
	</div>
	<div class="col-md-9">
		<div class="box">
			<div class="box-header with-border">
			 	<h3 class="box-title"><i class="fa fa-user-plus"></i> Registrar Nuevo Usuario</h3>

			 	<div class="box-tools pull-right">
			 		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
			      		<i class="fa fa-minus"></i>
			      	</button>
			  	</div>
			</div>
			<div class="box-body">
				{!! Form::open(['route' => 'users.store']) !!}
					@include('users.partials.form')
				{!! Form::close() !!}
		    </div>
			<!-- /.box-body -->
		</div>
	</div>
</div>
@include('users.partials.modal-foto')

@endsection




