@extends('layouts.app')

@section('title')
    Informes Tecnicos de Reposicion
@endsection

@section('head-content')
	<h1>
        <i class="fa fa-file-text"></i> 
		INFORMES TECNICOS DE REPOSICION
		<small>Cambio de Fecha</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-file"></i> Registrar cambio de Fecha</h3>
	</div>
	<div class="box-body">
		{!! Form::model($reposicion, ['route' => ['reposicions.storeCambiarFecha', $reposicion->id],'method'=>'POST', 'files'=>'true']) !!}
			@include('reposicions.partials.formCambiar')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection