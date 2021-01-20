@extends('layouts.app')

@section('title')
    Unidades
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-building"></i>
		UNIDAD
		<small>Nuevo Registro</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-building"></i> Registrar Nueva Unidad</h3>
	</div>
	<div class="box-body">
		{!! Form::open(['route' => 'unidads.store']) !!}
			@include('unidads.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection