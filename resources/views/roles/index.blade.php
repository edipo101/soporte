@extends('layouts.app')

@section('title')
    Roles
@endsection

@section('head-content')
    <h1>
        <i class="fa fa-server"></i>
        ROLES
        <small>Gestionar roles en el sistema</small>
    </h1>
@endsection

@section('main-content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-list"></i> LISTA DE ROLES</h3>

        <div class="box-tools">
            @can('roles.create')
            <a href="{{ route('roles.create') }}" class="btn btn-flat btn-primary pull-right">
                <i class="fa fa-plus-circle"></i> NUEVO ROL
            </a>
            @endcan
        </div>
    </div>
    <div class="box-body">
        <table id="roles" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th width="10px">#</th>
                    <th>NOMBRE</th>
                    <th width="100px">SLUG</th>
                    <th>DESCRIPCION</th>
                    <th>USUARIOS</th>
                    <th>PERMISOS</th>
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
    let tabla = $('#roles').DataTable({
        responsive: true,
    	autoWidth:false,
        language: {
            url: "{{ asset('plugins/datatables.net/Spanish.json') }}",
            searchPlaceholder: "Buscar rol..."
        },
        processing: true,
        serverSide: true,
        ajax: '{!! route('roles.apiRoles') !!}',
        columns: [
            { data: 'numero_index' },
            { data: 'name' },
            { data: 'slug' },
            { data: 'description' },
            { data: 'usuario' },
            { data: 'permisos' },
            { data: 'btn', orderable: false, searchable: false },
        ],
    });
    const eliminarRole = id =>{
		let ruta = `${direccion}/configuraciones/roles/${id}/delete`
		eliminar(ruta,'rol',tabla)
	};
</script>
@endsection