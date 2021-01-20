@extends('layouts.app')

@section('title')
    Informes Tecnicos de Reparacion
@endsection

@section('head-content')
	<h1>
        <i class="fa fa-file-text"></i> 
		INFORMES TECNICOS DE REPARACION
		<small>Cambio de Fecha</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-file"></i> Registrar cambio de Fecha</h3>
	</div>
	<div class="box-body">
		{!! Form::model($reparacion, ['route' => ['reparacions.storeCambiarFecha', $reparacion->id],'method'=>'POST', 'files'=>'true']) !!}
			@include('reparacions.partials.formCambiar')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection