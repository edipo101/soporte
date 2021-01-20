@extends('layouts.app')

@section('title')
    Servicios
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-bug"></i> 
		SERVICIO
		<small>Nuevo Registro</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-bug"></i> Registrar Nuevo Servicio</h3>
	</div>
	<div class="box-body">
		{!! Form::open(['route' => 'servicios.store']) !!}
			@include('servicios.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection