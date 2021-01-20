@extends('layouts.app')

@section('title')
    Informes Tecnicos de Reparacion
@endsection

@section('head-content')
	<h1>
        <i class="fa fa-wrench"></i> 
		INFORMES TECNICOS DE REPARACION
		<small>Nuevo registro</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-file"></i> Registrar de nuevo Informe Tecnico</h3>
	</div>
	<div class="box-body">
		{!! Form::model($reparacion_apartir, ['route' => ['reparacions.store', $reparacion_apartir->id],'method'=>'POST', 'files'=>'true']) !!}
			@include('reparacions.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection