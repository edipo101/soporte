@extends('layouts.app')

@section('title')
    Informes Tecnico de Baja
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-arrow-circle-down"></i> 
		INFORMES TECNICOS DE BAJA
		<small>Listado de informes tecnicos de baja registradas en el sistema</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-list"></i> LISTA DE INFORMES TECNICOS DE BAJA</h3>

	 	<div class="box-tools">
	 		@can('bajas.create')
			<a href="{{ route('bajas.create') }}" class="btn btn-flat btn-primary pull-right">
				<i class="fa fa-plus-circle"></i> NUEVO INFORME
			</a>
			@endcan
	  	</div>
	</div>
	<div class="box-body">
		<table id="bajas" class="table table-bordered table-striped table-hover">
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
    let tabla = $('#bajas').DataTable({
		responsive: true,
		autoWidth:false,
    	language: {
            url: "{{ asset('plugins/datatables.net/Spanish.json') }}",
            searchPlaceholder: "Buscar bajas..."
        },
        order: [[ 0, "desc" ]],
    	processing: true,
        serverSide: true,
        ajax: '{!! route('bajas.apiBajas') !!}',
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
	const eliminarBaja = id => {
		let ruta = `${direccion}/informes/bajas/${id}/delete`
		eliminar(ruta,'informe de baja',tabla)
	};
	let imprimirBaja = id => {
		let ruta = `${direccion}/informes/bajas/${id}/imprimir`
		imprimir(ruta)
	}
</script>
@endsection