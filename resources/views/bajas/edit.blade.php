@extends('layouts.app')

@section('title')
    Informes Tecnicos de Baja
@endsection

@section('head-content')
	<h1>
        <i class="fa fa-arrow-circle-down"></i>
		INFORMES TECNICOS DE BAJA
		<small>Actualizacion de datos del informe Tecnico de Baja</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-file"></i> Actualizar Informe</h3>
	</div>
	<div class="box-body">
		{!! Form::model($baja, ['route' => ['bajas.update', $baja->id], 'method' => 'PUT', 'files'=>'true']) !!}
			@include('bajas.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection