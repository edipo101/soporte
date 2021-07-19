@extends('layouts.app')

@section('title')
    Reportes
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-pie-chart"></i> 
		REPORTES
		<small>Listado de Reportes que genera el sistema</small>
	</h1> 
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-bar-chart"></i> REPORTES ESTADISTICOS</h3>
        <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
             </button>
         </div>
   </div>    

   <div class="box-body">
    <div class="container-fluid">

        {!! Form::model(null, ['route' => ['reportes.index'],'method'=>'POST']) !!}
        <div class="row">
            <div class="col-md-5">
                {{ Form::label('tdg', 'Tipo de gráfico') }}
                {!! Form::select('tipog', array('gaf' => 'Tickets Asignados y Finalizados', 'tfd' => 'Tickets finalizados por día'), null, ['class' => 'form-control text-uppercase']) !!}
            </div>
            <div class="col-md-2">
                {{ Form::label('df', 'De fecha') }}
                {{ Form::text('fecha_de', $from ,['class'=> 'form-control date','id' => 'fecha_de']) }}
            </div>
            <div class="col-md-2">
                {{ Form::label('af', 'A fecha') }}
                {{ Form::text('fecha_hasta', $to ,['class'=> 'form-control date','id' => 'fecha_hasta']) }}
            </div>
            <div class="col-md-3">
                {{ Form::label('empty', '_') }}
                {{ Form::submit('PROCESAR', ['class'=>'form-control btn btn-flat btn-success']) }}
            </div>
        </div>
        {!! Form::close() !!}

        <div class="row">
            <div class="col-md-12">
                {!! $chartjsx->render() !!}
            </div>
        </div>
    </div>
   </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.js') }}"></script>
<script src="{{ asset('plugins/moment/locale/es.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

<script type="text/javascript">    
$(function () {
    $('.date').datetimepicker({
    	format: 'YYYY-MM-DD',
    	locale: 'es'
    });
});
</script>

@endsection