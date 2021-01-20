@extends('layouts.app')

@section('title')
    Informes Tecnico de Recepcion
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-file-text"></i> 
		INFORMES TECNICOS DE RECEPCION
		<small>Listado de informes tecnicos de recepcion registradas en el sistema</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-list"></i> LISTA DE INFORMES TECNICOS DE RECEPCION</h3>

	 	<div class="box-tools">
	 		@can('recepcions.create')
			<a href="{{ route('recepcions.create') }}" class="btn btn-flat btn-primary pull-right">
				<i class="fa fa-plus-circle"></i> NUEVO INFORME
			</a>
			@endcan
	  	</div>
	</div>
	<div class="box-body">
		<table id="recepcions" class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th width="10px">#</th>
					<th>FECHA INF</th>
					<th>INF</th>
					<th>FECHA TICKET</th>
					<th>TICKET</th>
					<th>FUNCIONARIO</th>
					{{-- <th>UNIDAD</th> --}}
					<th>EMPRESA</th>
					<th>ORDEN COMPRA</th>
					<th>COMPONENTE</th>
					<th>ASUNTO</th>
					<th>USUARIO</th>
					<th width="10px">&nbsp;</th>
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
    let tabla = $('#recepcions').DataTable({
		responsive: true,
		autoWidth:false,
    	language: {
            url: "{{ asset('plugins/datatables.net/Spanish.json') }}",
            searchPlaceholder: "Buscar recepciones..."
        },
        order: [[ 0, "desc" ]],
    	processing: true,
        serverSide: true,
        ajax: '{!! route('recepcions.apiRecepcions') !!}',
        columns: [
			{ data: 'id', searchable: false, orderable: false },
            { data: 'fecha_informe' },
            { data: 'nro_informe' },
            { data: 'ticket.fecha_asignada' },
            { data: 'ticket.nro_ticket' },
            { data: 'ticket.solicitante' },
			// { data: 'ticket.unidad.nombre' },
			{ data: 'empresa' },
			{ data: 'orden_compra' },
            { data: 'ticket.componente.nombre' },
            { data: 'asunto' },
            { data: 'ticket.user.nickname' },
			{ data: 'btn', orderable: false, searchable: false },
        ],
	});
	const eliminarRecepcion = id => {
		let ruta = `${direccion}/informes/recepcions/${id}/delete`
		eliminar(ruta,'informe de recepcion',tabla)
	};
	let imprimirRecepcion = id => {
		let ruta = `${direccion}/informes/recepcions/${id}/imprimir`
		imprimir(ruta)
	}
</script>
@endsection