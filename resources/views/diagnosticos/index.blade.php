@extends('layouts.app')

@section('title')
    Diagnosticos
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-wrench"></i>
		DIAGNOSTICOS
		<small>Gestion de diagnosticos del sistema</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-list"></i> LISTA DE DIAGNOSTICOS</h3>

	 	<div class="box-tools">
	 		@can('diagnosticos.create')
			<a href="{{ route('diagnosticos.create') }}" class="btn btn-flat btn-primary pull-right">
				<i class="fa fa-plus-circle"></i> NUEVO DIAGNOSTICO
			</a>
			@endcan
	  	</div>
	</div>
	<div class="box-body">
		<table id='diagnosticos' class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th width="10px">#</th>
					<th>DIAGNOSTICO</th>
					<th>DESCRIPCION</th>
					<th>TICKETS</th>
					<th width="100px">ESTADO</th>
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
    let tabla = $('#diagnosticos').DataTable({
		responsive: true,
		autoWidth:false,
    	language: {
            url: "{{ asset('plugins/datatables.net/Spanish.json') }}",
            searchPlaceholder: "Buscar diagnostico..."
        },
    	processing: true,
        serverSide: true,
        ajax: '{!! route('diagnosticos.apiDiagnosticos') !!}',
        columns: [
			{ data: 'numero_index' },
            { data: 'nombre' },
            { data: 'descripcion' },
            { data: 'tickets' },
            { data: 'estado' },
            { data: 'btn', orderable: false, searchable: false },
        ],
	});
	const eliminarDiagnostico = id => {
		let ruta = `${direccion}/configuraciones/diagnosticos/${id}/delete`
		eliminar(ruta,'diagnostico',tabla)
	};
</script>
@endsection