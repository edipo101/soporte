@extends('layouts.app')

@section('title')
    Componentes
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-cube"></i>
		COMPONENTE
		<small>Actualización de datos del Componente</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-cube"></i> Actualizar Componente</h3>
	</div>
	<div class="box-body">
		{!! Form::model($componente, ['route' => ['componentes.update', $componente->id], 'method' => 'PUT']) !!}
			@include('componentes.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection