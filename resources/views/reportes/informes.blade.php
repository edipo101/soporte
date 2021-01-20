@extends('layouts.app')

@section('title')
    Reportes
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-calendar"></i> 
		REPORTES
		<small>Lista de Reportes que genera el Sistema</small>
	</h1>
@endsection

@section('main-content')
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-calendar"></i> REPORTE MENSUAL DE INFORMES TECNICOS</h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                @include('reportes.partials.form-mensual')
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-calendar"></i> REPORTE PERSONALIZADO DE INF. TECNICOS</h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                @include('reportes.partials.form')
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

@endsection

@section('css')
<!-- Datetime -->
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
@endsection

@section('scripts')
<!-- Datetime -->
<script src="{{ asset('plugins/moment/moment.js') }}"></script>
<script src="{{ asset('plugins/moment/locale/es.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
    //Date picker
    $('.date').datetimepicker({
        format: 'DD-MM-YYYY',
        locale: 'es'
    });
    
    $('.mes').datetimepicker({
        viewMode: 'months',
        format: 'MM',
        locale: 'es'
    });
    
    $('.anio').datetimepicker({
        viewMode: 'years',
        format: 'YYYY',
        locale: 'es'
    });
    let btnImprimirMes = document.getElementById('btn-imprimir-mes');
    let btnImprimir = document.getElementById('btn-imprimir');
    let mes = document.getElementById('mes'),
        anio = document.getElementById('anio'),
        fecha1 = document.getElementById('fecha1'),
        fecha2 = document.getElementById('fecha2'),
        tipo,
        usuario,
        ruta;

    btnImprimirMes.addEventListener('click', e=>{
        e.preventDefault();
        usuario = document.getElementById('usuariomes');
        tipo = document.getElementById('tipomes');
        ruta = `${direccion}/reportes/mensual/imprimir/${mes.value}/${anio.value}/${usuario.value}/${tipo.value}`;
        imprimir(ruta);
    })
    
    btnImprimir.addEventListener('click', e=>{
        e.preventDefault();
        usuario = document.getElementById('usuario');
        tipo = document.getElementById('tipo');
        ruta = `${direccion}/reportes/personalizado/imprimir/${fecha1.value}/${fecha2.value}/${usuario.value}/${tipo.value}`;  
        imprimir(ruta);
    })
</script>
@endsection