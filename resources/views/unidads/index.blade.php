@extends('layouts.app')

@section('title')
    Unidades
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-building"></i> 
		UNIDADES
		<small>Gestion de unidades del sistema</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-list"></i> LISTA DE UNIDADES</h3>

	 	<div class="box-tools">
			@can('unidads.create')
			<a href="{{ route('unidads.create') }}" class="btn btn-flat btn-primary pull-right">
				<i class="fa fa-plus-circle"></i> NUEVA UNIDAD
			</a>
			@endcan
	  	</div>
	</div>
	<div class="box-body">
		<table id="unidades" class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th width="10px">#</th>
					<th>UNIDAD</th>
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
    let tabla = $('#unidades').DataTable({
		responsive: true,
		autoWidth:false,
    	language: {
            url: "{{ asset('plugins/datatables.net/Spanish.json') }}",
            searchPlaceholder: "Buscar unidad..."
		},
		order: [[ 1, "asc" ]],
    	processing: true,
        serverSide: true,
        ajax: '{!! route('unidads.apiUnidads') !!}',
        columns: [
			{ data: 'numero_index' },
            { data: 'nombre' },
            { data: 'btn', orderable: false, searchable: false },
        ],
	});
	const eliminarUnidad = id => {
		let ruta = `${direccion}/configuraciones/unidads/${id}/delete`
		eliminar(ruta,'unidad',tabla)
	};
</script>
@endsection