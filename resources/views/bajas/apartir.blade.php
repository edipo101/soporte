@extends('layouts.app')

@section('title')
    Informes Tecnicos de Baja
@endsection

@section('head-content')
	<h1>
        <i class="fa fa-arrow-circle-down"></i> 
		INFORMES TECNICOS DE BAJA
		<small>Nuevo registro</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-file"></i> Registrar de nuevo Informe Tecnico</h3>
	</div>
	<div class="box-body">
		{!! Form::model($baja_apartir, ['route' => ['bajas.store', $baja_apartir->id],'method'=>'POST', 'files'=>'true']) !!}
			@include('bajas.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection