@extends('layouts.app')

@section('title')
    Usuarios
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-users"></i> 
		USUARIOS
		<small>Gestion de usuarios del sistema</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-list"></i> LISTA DE USUARIOS</h3>

	 	<div class="box-tools">
			@can('users.create')
			<a href="{{ route('users.create') }}" class="btn btn-flat btn-primary pull-right">
				<i class="fa fa-plus-circle"></i> NUEVO USUARIO
			</a>
			@endcan
	  	</div>
	</div>
	<div class="box-body">
		<table id="users" class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th width="10px">#</th>
					<th>FOTO</th>
					<th>CARNET</th>
					<th>NOMBRE COMPLETO</th>
					<th>CARGO</th>
					<th>USUARIO</th>
					<th>ROLES</th>
					<th width="8%">&nbsp;</th>
				</tr>
			</thead>
		</table>
    </div>
	<!-- /.box-body -->
</div>

@endsection

@section('scripts')
<script>
    let tabla = $('#users').DataTable({
		responsive: true,
		autoWidth:false,
    	language: {
            url: "{{ asset('plugins/datatables.net/Spanish.json') }}",
            searchPlaceholder: "Buscar usuario..."
        },
        order: [[ 2, "asc" ]],
    	processing: true,
        serverSide: true,
        ajax: '{!! route('users.apiUsers') !!}',
        columns: [
            { data: 'numero_index' },
            { data: 'foto' },
            { data: 'carnet' },
            { data: 'nombre' },
            { data: 'cargo' },
            { data: 'user.nickname' },
            { data: 'roles' },
            { data: 'btn', orderable: false, searchable: false },
        ],
    });
	const eliminarUser = id => {
		let ruta = `${direccion}/configuraciones/users/${id}/delete`
		eliminar(ruta,'usuario',tabla)
	};
</script>
@endsection