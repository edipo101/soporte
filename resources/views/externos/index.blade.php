@extends('layouts.app')

@section('title')
    Informes Externos
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-external-link"></i> 
		INFORMES EXTERNOS
		<small>Listado de informes externos registrado en el sistema</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-list"></i> LISTA DE INFORMES EXTERNOS</h3>

	 	<div class="box-tools">
             <a href="{{ asset('plantillas/plantilla_soporte_externo.docx') }}" class="btn btn-link">
                PLANTILLA DE SOPORTE EXTERNO
            </a>
	 		@can('externos.create')
            <a href="{{ route('externos.create') }}" class="btn btn-flat btn-primary pull-right">
                <i class="fa fa-plus-circle"></i> NUEVO INFORME EXTERNO
            </a>
            @endcan
	  	</div>
	</div>
	<div class="box-body">
        <table id="externos" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th width="10px">#</th>
                    <th>FECHA INFORME</th>
                    <th>FUNCIONARIO</th>
                    <th>UNIDAD/OFICINA</th>
                    <th>SERVICIOS</th>
                    <th>DESCRIPCION</th>
                    <th>USUARIO</th>
                    <th width="150px">&nbsp;</th>
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
    let tabla = $('#externos').DataTable({
        responsive: true,
		autoWidth:false,
    	language: {
            url: "{{ asset('plugins/datatables.net/Spanish.json') }}",
            searchPlaceholder: "Buscar externo..."
        },
    	processing: true,
        serverSide: true,
        ajax: '{!! route('externos.apiExternos') !!}',
        columns: [
            { data: 'numero_index', orderable:false, searchable:false },
            { data: 'fecha_elaboracion' },
            { data: 'nombre' },
            { data: 'unidad.nombre' },
            { data: 'servicios' },
            { data: 'descripcion' },
            { data: 'user.nickname' },
            { data: 'btn', orderable: false, searchable: false },
        ],
    });
    const eliminarExterno = id => {
		let ruta = `${direccion}/informes/externos/${id}/delete`
		eliminar(ruta,'informe de externo',tabla)
	};
	let imprimirExterno = id => {
		let ruta = `${direccion}/informes/externos/${id}/imprimir`
		imprimir(ruta)
	}
</script>
@endsection