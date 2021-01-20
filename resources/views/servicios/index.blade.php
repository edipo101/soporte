@extends('layouts.app')

@section('title')
    Servicios
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-bug"></i>
		SERVICIOS
		<small>Gestion de servicios del sistema</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-list"></i> LISTA DE SERVICIOS</h3>

	 	<div class="box-tools">
	 		@can('servicios.create')
			<a href="{{ route('servicios.create') }}" class="btn btn-flat btn-primary pull-right">
				<i class="fa fa-plus-circle"></i> NUEVO SERVICIO
			</a>
			@endcan
	  	</div>
	</div>
	<div class="box-body">
		<table id='servicios' class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th width="10px">#</th>
					<th>DIAGNOSTICO</th>
					<th>DESCRIPCION</th>
					<th width="150px">&nbsp;</th>
				</tr>
			</thead>
		</table>
    </div>
	<!-- /.box-body -->
</div>

@endsection

@section('scripts')
<script>
    let tabla = $('#servicios').DataTable({
		responsive: true,
		autoWidth:false,
    	language: {
            url: "{{ asset('plugins/datatables.net/Spanish.json') }}",
            searchPlaceholder: "Buscar servicio..."
        },
    	processing: true,
        serverSide: true,
        ajax: '{!! route('servicios.apiServicios') !!}',
        columns: [
			{ data: 'numero_index' },
            { data: 'nombre' },
            { data: 'descripcion' },
            { data: 'btn', orderable: false, searchable: false },
        ],
	});
	const eliminarServicio = id => {
		let ruta = `${direccion}/configuraciones/servicios/${id}/delete`
		eliminar(ruta,'servicio',tabla)
	};
</script>
@endsection