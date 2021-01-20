@extends('layouts.app')

@section('title')
    Usuarios
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-user"></i> 
		USUARIO
		<small>Actualización de datos del Usuario</small>
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
			 	<h3 class="box-title"><i class="fa fa-user-plus"></i> Actualizar Usuario</h3>

			 	<div class="box-tools pull-right">
			 		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
			      		<i class="fa fa-minus"></i>
			      	</button>
			    	<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
			      		<i class="fa fa-times"></i>
			      	</button>
			  	</div>
			</div>
			<div class="box-body">
				{!! Form::model($tecnico, ['route' => ['users.update', $tecnico->id], 'method' => 'PUT']) !!}
					@include('users.partials.form')
				{!! Form::close() !!}
		    </div>
			<!-- /.box-body -->
		</div>
	</div>
</div>

@include('users.partials.modal-foto')

@endsection