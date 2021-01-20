@extends('layouts.app')

@section('title')
    Direcciones IP
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-wifi"></i>
		DIRECCION IP
		<small>Actualización de datos de la direccion IP</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-wifi"></i> Actualizar Direccion IP</h3>
	</div>
	<div class="box-body">
		{!! Form::model($direccion, ['route' => ['direccions.update', $direccion->id], 'method' => 'PUT']) !!}
			@include('direccions.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection