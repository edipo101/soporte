@extends('layouts.app')

@section('title')
    Informes Tecnicos de Reposicion
@endsection

@section('head-content')
	<h1>
        <i class="fa fa-cogs"></i> 
		INFORMES TECNICOS DE REPOSICION
		<small>Nuevo registro</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-file"></i> Registrar de nuevo Informe Tecnico</h3>
	</div>
	<div class="box-body">
		{!! Form::model($reposicion_apartir, ['route' => ['reposicions.store', $reposicion_apartir->id],'method'=>'POST', 'files'=>'true']) !!}
			@include('reposicions.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection