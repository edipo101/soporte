@extends('layouts.app')

@section('title')
    Direcciones IP
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-wifi"></i> 
		DIRECCIONES IP
		<small>Gestion de direcciones IP registrado en el sistema</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-list"></i> LISTA DE DIRECCIONES IP</h3>

	 	<div class="box-tools">
	 		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          	</button>
	  	</div>
	</div>
	<div class="box-body">
		@can('direccions.importar')
		<a href="{{ route('direccions.importar') }}" class="btn btn-flat btn-success pull-right">
			<i class="fa fa-download"></i> IMPORTAR DIRECCION IP's
		</a>
		<a href="{{ asset('plantillas/plantilla-ips.xlsx') }}" class="btn btn-flat btn-warning pull-right" target="_blank">
			<i class="fa fa-file-o"></i> DESCARGAR PLANTILLA DE IP's
		</a>
		@endcan
		@can('direccions.create')
		<a href="{{ route('direccions.create') }}" class="btn btn-flat btn-primary pull-right">
			<i class="fa fa-plus-circle"></i> NUEVA DIRECCION IP
		</a>
		<br><br>
		@endcan
		<table id="direcciones" class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th width="10px">#</th>
					<th>IP</th>
					<th>Funcionario</th>
					<th>Equipo</th>
					<th>Cargo</th>
					<th>Unidad</th>
					<th>MAC</th>
					<th>Red IMP</th>
					<th>Internet</th>
					<th>SIGMA</th>
					{{-- <th>SIGEP</th> --}}
					<th>Usuario</th>
					{{-- <th>Observaciones</th> --}}
					<th width="25px">&nbsp;</th>
				</tr>
			</thead>
		</table>
    </div>
	<!-- /.box-body -->
</div>

@endsection

@section('scripts')
<script>
    let tabla = $('#direcciones').DataTable({
		responsive: true,
		autoWidth:false,
    	language: {
            url: "{{ asset('plugins/datatables.net/Spanish.json') }}",
            searchPlaceholder: "Buscar direccion IP..."
		},
		order: [[ 1, "asc" ]],
    	processing: true,
        serverSide: true,
        ajax: '{!! route('direccions.apiDireccions') !!}',
        columns: [
			{ data: 'numero_index' },
			{ data: 'ipv4' },
			{ data: 'funcionario' },
			{ data: 'nombrepc' },
			{ data: 'cargo' },
			{ data: 'unidad' },
			{ data: 'mac' },
			{ data: 'redimpresora' },
			{ data: 'internet' },
			{ data: 'sigma' },
			// { data: 'sigep' },
			{ data: 'user.nickname' },
			// { data: 'observacion' },
            { data: 'btn', orderable: false, searchable: false },
        ],
	});
	const eliminarDireccion = id => {4
		let ruta = `${direccion}/direccions/${id}/delete`
		eliminar(ruta,'direccion',tabla)
	};
</script>
@endsection