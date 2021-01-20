@extends('layouts.app')

@section('title')
    Tickets
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-tag"></i> 
		TICKET
		<small>Actualización de datos del Ticket</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-tag"></i> Actualizar Ticket</h3>
	</div>
	<div class="box-body">
		{!! Form::model($ticket, ['route' => ['tickets.update', $ticket->id], 'method' => 'PUT']) !!}
			@include('tickets.partials.form')
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection