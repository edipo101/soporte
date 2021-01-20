@extends('layouts.app')

@section('title')
    Direcciones IP
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-wifi"></i>
		DIRECCIONES IP
		<small>Importacion de Direcciones IP's</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-wifi"></i>  Importar Direcciones IP's</h3>

	 	<div class="box-tools pull-right">
	 		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
	      		<i class="fa fa-minus"></i>
	      	</button>
	    	<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
	      		<i class="fa fa-times"></i>
	      	</button>
	  	</div>
	</div>
	<div class="box-body">
		{!! Form::open(['route' => 'direccions.storeimportar','files'=>'true']) !!}
			<div class="form-group">
			    {{ Form::label('archivo', 'Archivo Excel:',['class'=>'form-label'])}} 
			    <input class="form-control" id="archivo" name="archivo" type="file">
			</div>
			<div class="form-group text-center">
			{{ Form::submit('IMPORTAR DATOS', ['class'=>'btn btn-flat btn-primary']) }}
			<a href="{{ route('direccions.index') }}" class="btn btn-flat btn-danger">CANCELAR</a>
		</div>
		{!! Form::close() !!}
    </div>
	<!-- /.box-body -->
</div>

@endsection