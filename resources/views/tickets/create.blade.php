@extends('layouts.app')

@section('title')
    Tickets
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-tag"></i> 
		TICKET {{ strtoupper($tipo) }}
		<small>Nuevo Registro</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-tag"></i> Registrar Nuevo Ticket</h3>
	</div>
	<div class="box-body">
		{!! Form::open(['route' => 'tickets.store']) !!}
			@include('tickets.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection