@extends('layouts.app')

@section('title')
    Componentes
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('fonts/fonts-soporte/style.css') }}">
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-cubes"></i> 
		COMPONENTES
		<small>Gestion de componentes del sistema</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-list"></i> LISTA DE COMPONENTES</h3>

	 	<div class="box-tools">
	 		@can('componentes.create')
			<a href="{{ route('componentes.create') }}" class="btn btn-flat btn-primary pull-right">
				<i class="fa fa-plus-circle"></i> NUEVO COMPONENTE
			</a>
			@endcan
	  	</div>
	</div>
	<div class="box-body">
		<table id="componentes" class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th width="10px">#</th>
					<th width="20px">ICONO</th>
					<th>COMPONENTE</th>
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
    let tabla = $('#componentes').DataTable({
		responsive: true,
		autoWidth:false,
    	language: {
            url: "{{ asset('plugins/datatables.net/Spanish.json') }}",
            searchPlaceholder: "Buscar componente..."
		},
		order: [[ 2, "asc" ]],
    	processing: true,
        serverSide: true,
        ajax: '{!! route('componentes.apiComponentes') !!}',
        columns: [
			{ data: 'numero_index' },
            { data: 'icono' },
            { data: 'nombre' },
            { data: 'btn', orderable: false, searchable: false },
        ],
	});
	const eliminarComponente = id => {
		let ruta = `${direccion}/configuraciones/componentes/${id}/delete`
		eliminar(ruta,'componente',tabla)
	};
</script>
@endsection