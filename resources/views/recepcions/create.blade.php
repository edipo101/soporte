@extends('layouts.app')

@section('title')
    Informes Tecnicos de Recepcion
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-file-text"></i> 
		INFORMES TECNICOS DE RECEPCION
		<small>Nuevo Registro</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-file"></i> Registro de nuevo Informe Tecnico</h3>
	</div>
	<div class="box-body">
		{!! Form::open(['route' => 'recepcions.store', 'files' => true]) !!}
			@include('recepcions.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection