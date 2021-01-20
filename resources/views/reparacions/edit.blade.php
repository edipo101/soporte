@extends('layouts.app')

@section('title')
    Informes Tecnicos de Reparacion
@endsection

@section('head-content')
	<h1>
        <i class="fa fa-wrench"></i>
		INFORMES TECNICOS DE REPARACION
		<small>Actualizacion de datos del informe Tecnico de Reparacion</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-file"></i> Actualizar Informe</h3>
	</div>
	<div class="box-body">
		{!! Form::model($reparacion, ['route' => ['reparacions.update', $reparacion->id], 'method' => 'PUT', 'files'=>'true']) !!}
			@include('reparacions.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection