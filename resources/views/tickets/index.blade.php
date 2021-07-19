@extends('layouts.app')

@section('title')
    Tickets
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-tags"></i> 
		TICKETS {{ strtoupper($estado) }}
		<small>Listado de tickets registrados</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-list"></i> Lista de Tickets {{ ucfirst($estado) }}</h3>

	 	<div class="box-tools">
	 		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          	</button>
	  	</div>
	</div>
	<div class="box-body">
		
		{!! Form::open(['route' => ['tickets.index', $estado ] , 'class'=>'form-inline', 'id'=>'fexternos', 'method' => 'GET' ]) !!}
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					{{ Form::label('gestion', 'Gestión :&nbsp;&nbsp;') }}
					{{ Form::select('gestion', array('2021' => '2021', '2020' => '2020','2019' => '2019','2018' => '2018'), $gestion,['class'=> 'form-control', 'id'=>'gestion']) }}
				</div>
			</div> 
			<div class="col-md-2">
				<div class="form-group">
					<button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
				</div>
			</div>
			<div class="col-md-8">
				@can('tickets.create')		
				@if($tipo=='R') 
				<a href="{{ route('tickets.create','empresa') }}" class="btn btn-app bg-blue pull-right">
					<i class="fa fa-building"></i> TICKET PARA EMPRESA
				</a>
				<a href="{{ route('tickets.create','gams') }}" class="btn btn-app bg-red pull-right">
					<i class="fa fa-tags"></i> TICKET PARA GAMS
				</a>
				<div class="clearfix"></div>
				@endif
			@endcan
			</div>
		</div>
		{!! Form::close() !!}
		<hr/>
		
		<div class="row">
			<div class="col-md-12">
				<table id="tickets" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th width="10px">#</th>
							<th>TICKET</th>
							<th>FECHA REC.</th>
							@if($tipo!='T')
							<th>FECHA ASIGNADA</th>
							<th>FECHA ENTREGA</th>							
							@endif		
							<th>SOLICITUD POR</th>							
							<th>COMPONENTE</th>
							<th>OBSERVACION</th>
							@if($tipo=='R')
								<th>RECEPCIONADO</th>							
							@elseif($tipo=='A')
								<th>ASIGNADO</th>
							@elseif($tipo=='F')
								<th>FINALIZADO</th>
							@elseif($tipo=='T')
								<th>RESUELTO</th>								
							@else
								<th></th>
							@endif							
							<th width="50px">&nbsp;</th>
						</tr>
					</thead>
				</table>
			</div>			
		</div>

		@if($tipo=='R')
		<div style="display:table;">    
			<span class="leyenda_esp_label">Recepcionado hace </span>
			<span class="lbox row_green"></span> <span class="leyenda_esp_label">menos de 7 días</span>		
			<span class="lbox row_yellow"></span> <span class="leyenda_esp_label">más de 7 días</span>    
			<span class="lbox row_red"></span> <span class="leyenda_esp_label">más de 12 días</span>    
		</div>	
		@elseif($tipo=='A')
		<div style="display:table;">    
			<span class="leyenda_esp_label">Asignado hace </span>
			<span class="lbox row_green"></span> <span class="leyenda_esp_label">menos de 7 días</span>		
			<span class="lbox row_yellow"></span> <span class="leyenda_esp_label">más de 7 días</span>    
			<span class="lbox row_red"></span> <span class="leyenda_esp_label">más de 12 días</span>    
		</div>
		@elseif($tipo=='F')
		<div style="display:table;">    
			<span class="leyenda_esp_label">Finalizado </span>
			<span class="lbox row_green"></span> <span class="leyenda_esp_label">Dentro el plazo (3dias)</span>		
			<span class="lbox row_yellow"></span> <span class="leyenda_esp_label">más de 3 días</span>    
			<span class="lbox row_red"></span> <span class="leyenda_esp_label">más de 6 días</span>    
		</div>	
		@endif					
    </div>
	<!-- /.box-body -->
</div>
@include('reportes.imprimir.modal-imprimir')

@endsection

@section('scripts')
<script>
	@if($tipo=='T')
	const dataTickets = [
		{ data: 'numero_index' },
		{ data: 'nro_ticket' },
		{ data: 'created_at' },		
		{ data: 'solicitante' },            
		{ data: 'componente.nombre' },
		{ data: 'observacion' },
		{ data: 'user.nickname' },
		{ data: 'btn', orderable: false, searchable: false },
	];
	@else
	const dataTickets = [
		{ data: 'numero_index' },
		{ data: 'nro_ticket' },
		{ data: 'created_at' },
		{ data: 'fecha_asignada' },
		{ data: 'fecha_entrega' },            
		{ data: 'solicitante' },            
		{ data: 'componente.nombre' },
		{ data: 'observacion' },
		{ data: 'user.nickname' },
		{ data: 'btn', orderable: false, searchable: false },
	];
	@endif	

	const apiTickets = '{!! route('tickets.apiTickets', [$tipo, $gestion] ) !!}';
	let tabla = $('#tickets').DataTable({
		"order": [[ 0, "desc" ]],
		"serverSide" : true,
		"processing": true,
		"ajax" : apiTickets,
		"columns": dataTickets,
		language: {
			url: "{{ asset('plugins/datatables.net/Spanish.json') }}",
				searchPlaceholder: "Buscar ticket..."
		},      
	});  

	//$.fn.dataTable.ext.errMode = 'throw';

	const eliminarTicket = id => {
		let ruta = `${direccion}/tickets/${id}/delete`
		eliminar(ruta,'ticket',tabla)
	};

	const resolverTicket = id => {
		let ruta = `${direccion}/tickets/${id}/resolver`
		resolver(ruta,'ticket',tabla)
	};

	const deshacerTicket = id => {
		let ruta = `${direccion}/tickets/${id}/deshacerresuelto`
		deshacer(ruta,'ticket',tabla)
	};

	

	let imprimirTicket = id => {
		let ruta = `${direccion}/tickets/${id}/imprimir`
		imprimir(ruta)
	}	

</script>
@endsection