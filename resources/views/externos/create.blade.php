@extends('layouts.app')

@section('title')
    Informes Tecnicos Externos
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-external-link"></i> 
		INFORMES TECNICOS EXTERNOS
		<small>Nuevo Registro</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-file"></i> Registro de nuevo Informe Tecnico</h3>
	</div>
	<div class="box-body">
		{!! Form::open(['route' => 'externos.store']) !!}
			@include('externos.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection