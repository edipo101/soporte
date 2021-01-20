@extends('layouts.app')

@section('title')
    Diagnosticos
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-wrench"></i> 
		DIAGNOSTICO
		<small>Actualización de datos del diagnostico</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-wrench"></i> Actualizar Diagnostico</h3>
	</div>
	<div class="box-body">
		{!! Form::model($diagnostico, ['route' => ['diagnosticos.update', $diagnostico->id], 'method' => 'PUT']) !!}
			@include('diagnosticos.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection