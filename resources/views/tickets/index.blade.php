@extends('layouts.app')

@section('title')
    Tickets
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-tags"></i> 
		TICKETS {{ strtoupper($estado) }}
		<small>Listado de tickets registrados en el sistema</small>
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
		<table id="tickets" class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th width="10px">#</th>
					<th>TICKET</th>
					<th>FECHA REC.</th>
					<th>FECHA ASIGNADA</th>
					<th>FECHA ENTREGA</th>
					{{-- <th>Unidad</th> --}}
					<th>SOLICITUD POR</th>
					<th>TELF./CEL.</th>
					<th>COMPONENTE</th>
					<th>OBSERVACION</th>
					<th>ESTADO</th>
					<th width="50px">&nbsp;</th>
				</tr>
			</thead>
		</table>
    </div>
	<!-- /.box-body -->
</div>
@include('reportes.imprimir.modal-imprimir')

@endsection

@section('scripts')
<script>
    let tabla = $('#tickets').DataTable({
		responsive: true,
		autoWidth:false,
    	language: {
            url: "{{ asset('plugins/datatables.net/Spanish.json') }}",
            searchPlaceholder: "Buscar ticket..."
        },
        order: [[ 0, "desc" ]],
    	processing: true,
        serverSide: true,
        ajax: '{!! route('tickets.apiTickets',$tipo) !!}',
        columns: [
            { data: 'numero_index' },
            { data: 'nro_ticket' },
            { data: 'created_at' },
            { data: 'fecha_asignada' },
            { data: 'fecha_entrega' },
            // { data: 'unidad.nombre' },
            { data: 'solicitante' },
            { data: 'celular_referencia' },
            { data: 'componente.nombre' },
            { data: 'observacion' },
            { data: 'user.nickname' },
            { data: 'btn', orderable: false, searchable: false },
        ],
    });
	const eliminarTicket = id => {
		let ruta = `${direccion}/tickets/${id}/delete`
		eliminar(ruta,'ticket',tabla)
	};
	let imprimirTicket = id => {
		let ruta = `${direccion}/tickets/${id}/imprimir`
		imprimir(ruta)
	}
</script>
@endsection