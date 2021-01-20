@extends('layouts.app')

@section('title')
    Informes Tecnicos de Reposicion
@endsection

@section('head-content')
	<h1>
        <i class="fa fa-cogs"></i>
		INFORMES TECNICOS DE REPOSICION
		<small>Actualizacion de datos del informe Tecnico de Reposicion</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-file"></i> Actualizar Informe</h3>
	</div>
	<div class="box-body">
		{!! Form::model($reposicion, ['route' => ['reposicions.update', $reposicion->id], 'method' => 'PUT', 'files'=>'true']) !!}
			@include('reposicions.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection