@extends('layouts.app')

@section('title')
    Diagnosticos
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-wrench"></i> 
		DIAGNOSTICO
		<small>Nuevo Registro</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-wrench"></i> Registrar Nuevo Diagnostico</h3>
	</div>
	<div class="box-body">
		{!! Form::open(['route' => 'diagnosticos.store']) !!}
			@include('diagnosticos.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection