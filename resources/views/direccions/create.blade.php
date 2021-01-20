@extends('layouts.app')

@section('title')
    Direcciones IP
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-wifi"></i>
		DIRECCIONES IP
		<small>Nuevo Registro</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-wifi"></i> Registrar Nueva Direccion IP</h3>
	</div>
	<div class="box-body">
		{!! Form::open(['route' => 'direccions.store']) !!}
			@include('direccions.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection