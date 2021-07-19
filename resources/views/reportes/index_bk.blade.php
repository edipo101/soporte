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
        <div class="row">
            <div class="col-md-12">
                {!! $chartjsx->render() !!}
            </div>
        </div>
    </div>
   </div>
</div>


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
            <div class="row">
                <div class="col-md-7">
                <!-- Reporte estadisticos de barra para mostrar todos los ticket asignados, finalizados a los tecnicos -->
                    {!! $chartjs->render() !!}
                </div>
                <div class="col-md-5">
                    <h4 class="text-center"> TECNICOS DE LA UNIDAD DE SOPORTE</h4>
                    <br>
                <!-- Tabla del reporte estadisticos -->
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr class="bg-black">
                                <th>Tecnico</th>
                                <th>Tickets Asignados</th>
                                <th>Tickets Finalizados</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="text-center">
                                    <td>{{ $user->tecnico->fullnombre }}</td>
                                    <td>{{ $user->tickets->where('estado','A')->count() }}</td>
                                    <td>{{ $user->tickets->where('estado','F')->count() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	<!-- /.box-body -->
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box">
	        <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-pie-chart"></i> REPORTE GLOBAL DE TICKETS</h3>
                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
	        </div>
	        <div class="box-body">
                {!! $chartjs2->render() !!}
                <br>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr class="bg-black">
                            <th>TICKETS</th>
                            <th>CANTIDAD</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>RECEPCIONADOS</td>
                            <td>{{ $tickets->where('estado','R')->count() }}</td>
                        </tr>
                        <tr class="text-center">
                            <td>ASIGNADOS</td>
                            <td>{{ $tickets->where('estado','A')->count() }}</td>
                        </tr>
                        <tr class="text-center">
                            <td>FINALIZADOS</td>
                            <td>{{ $tickets->where('estado','F')->count() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
	        <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-pie-chart"></i> INFORMES TECNICOS</h3>
                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
	        </div>
	        <div class="box-body">
                {!! $chartjs3->render() !!}
                <br>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr class="bg-black">
                            <th>INFORME TECNICO</th>
                            <th>CANTIDAD</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>RECEPCION</td>
                            <td>{{ $recepcions }}</td>
                            <td>{{ $recepcions == 0 ? '0' :round($recepcions * 100 / $total,2) }} %</td>
                        </tr>
                        <tr class="text-center">
                            <td>REPARACION</td>
                            <td>{{ $reparacions }}</td>
                            <td>{{ $reparacions == 0 ? '0' :round($reparacions * 100 / $total,2) }} %</td>
                        </tr>
                        <tr class="text-center">
                            <td>REPOSICION</td>
                            <td>{{ $reposicions }}</td>
                            <td>{{ $reposicions == 0 ? '0' :round($reposicions * 100 / $total,2) }} %</td>
                        </tr>
                        <tr class="text-center">
                            <td>BAJA</td>
                            <td>{{ $bajas }}</td>
                            <td>{{ $bajas == 0 ? '0' :round($bajas * 100 / $total,2) }} %</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

@endsection