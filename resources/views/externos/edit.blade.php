@extends('layouts.app')

@section('title')
    Informes Tecnicos Externos
@endsection

@section('head-content')
	<h1>
        <i class="fa fa-external-link"></i>
		INFORMES TECNICOS EXTERNOS
		<small>Actualizacion de datos del informe Tecnico de Baja</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-file"></i> Actualizar Informe</h3>
	</div>
	<div class="box-body">
		{!! Form::model($externo, ['route' => ['externos.update', $externo->id], 'method' => 'PUT', 'files'=>'true']) !!}
			@include('externos.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection