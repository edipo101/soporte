@extends('layouts.app')

@section('title')
    Informes Tecnico de Reposicion
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-cogs"></i> 
		INFORMES TECNICOS DE REPOSICION
		<small>Listado de informes tecnicos de reposicion registradas en el sistema</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-list"></i> LISTA DE INFORMES TECNICOS DE REPOSICION</h3>

	 	<div class="box-tools">
			@can('reposicions.create')
			<a href="{{ route('reposicions.create') }}" class="btn btn-flat btn-primary pull-right">
				<i class="fa fa-plus-circle"></i> NUEVO INFORME
			</a>
			@endcan
	  	</div>
	</div>
	<div class="box-body">
		<table id="reposicions" class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th width="10px">#</th>
					<th>FECHA INF</th>
					<th>INF</th>
					<th>FECHA TICKET</th>
					<th>TICKET</th>
					<th>FUNCIONARIO</th>
					{{-- <th>UNIDAD</th> --}}
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
    let tabla = $('#reposicions').DataTable({
		responsive: true,
		autoWidth:false,
    	language: {
            url: "{{ asset('plugins/datatables.net/Spanish.json') }}",
            searchPlaceholder: "Buscar reposiciones..."
        },
        order: [[ 0, "desc" ]],
    	processing: true,
        serverSide: true,
        ajax: '{!! route('reposicions.apiReposicions') !!}',
        columns: [
            { data: 'numero_index' },
            { data: 'fecha_informe' },
            { data: 'nro_informe' },
            { data: 'ticket.fecha_asignada' },
            { data: 'ticket.nro_ticket' },
            { data: 'ticket.solicitante' },
            // { data: 'ticket.unidad.nombre' },
            { data: 'ticket.componente.nombre' },
            { data: 'asunto' },
            { data: 'ticket.user.nickname' },
            { data: 'btn', orderable: false, searchable: false },
        ],
	});
	const eliminarReposicion = id => {
		let ruta = `${direccion}/informes/reposicions/${id}/delete`
		eliminar(ruta,'informe de reposicion',tabla)
	};
	let imprimirReposicion = id => {
		let ruta = `${direccion}/informes/reposicions/${id}/imprimir`
		imprimir(ruta)
	}
</script>
@endsection