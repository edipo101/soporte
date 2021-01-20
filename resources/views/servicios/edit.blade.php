@extends('layouts.app')

@section('title')
    Servicios
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-bug"></i> 
		SERVICIO
		<small>Actualización de datos del servicio</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-bug"></i> Actualizar Servicio</h3>
	</div>
	<div class="box-body">
		{!! Form::model($servicio, ['route' => ['servicios.update', $servicio->id], 'method' => 'PUT']) !!}
			@include('servicios.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection