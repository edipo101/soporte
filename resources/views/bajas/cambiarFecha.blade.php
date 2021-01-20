@extends('layouts.app')

@section('title')
    Informes Tecnicos de Baja
@endsection

@section('head-content')
	<h1>
        <i class="fa fa-file-text"></i> 
		INFORMES TECNICOS DE BAJA
		<small>Cambio de Fecha</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-file"></i> Registrar cambio de Fecha</h3>
	</div>
	<div class="box-body">
		{!! Form::model($baja, ['route' => ['bajas.storeCambiarFecha', $baja->id],'method'=>'POST', 'files'=>'true']) !!}
			@include('bajas.partials.formCambiar')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection