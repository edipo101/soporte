@extends('layouts.app')

@section('title')
    Informes Tecnico de Reparacion
@endsection

@section('head-content')
	<h1>
		<i class="fa fa-wrench"></i> 
		INFORMES TECNICOS DE REPARACION
		<small>Listado de informes tecnicos de reparacion registradas en el sistema</small>
	</h1>
@endsection

@section('main-content')
<div class="box">
	<div class="box-header with-border">
	 	<h3 class="box-title"><i class="fa fa-list"></i> LISTA DE INFORMES TECNICOS DE REPARACION</h3>

	 	<div class="box-tools">
	 		@can('reparacions.create')
			<a href="{{ route('reparacions.create') }}" class="btn btn-flat btn-primary pull-right">
				<i class="fa fa-plus-circle"></i> NUEVO INFORME
			</a>
			@endcan
	  	</div>
	</div>

	<div class="box-body">
		{!! Form::open(['route' => ['reparacions.index'] , 'class'=>'form-inline', 'id'=>'fexternos', 'method' => 'GET' ]) !!}
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						{{ Form::label('gestion', 'Gestión :&nbsp;&nbsp;') }}
						{{ Form::select('gestion', array('2021' => '2021', '2020' => '2020','2019' => '2019','2018' => '2018'), $gestion,['class'=> 'form-control', 'id'=>'gestion']) }}
					</div>
				</div> 
				<div class="col-md-2">
					<div class="form-group">
						<button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
					</div>
				</div>
				<div class="col-md-8">
					
				</div>
			</div>
			{!! Form::close() !!}
			<hr/>
	</div>


	<div class="box-body">
		<table id="reparacions" class="table table-bordered table-striped table-hover">
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
    let tabla = $('#reparacions').DataTable({
		responsive: true,
		autoWidth:false,
    	language: {
            url: "{{ asset('plugins/datatables.net/Spanish.json') }}",
            searchPlaceholder: "Buscar reparaciones..."
        },
        order: [[ 0, "desc" ]],
    	processing: true,
        serverSide: true,
        ajax: '{!! route('reparacions.apiReparacions', $gestion ) !!}',
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
	const eliminarReparacion = id => {
		let ruta = `${direccion}/informes/reparacions/${id}/delete`
		eliminar(ruta,'informe de reparacion',tabla)
	};
	let imprimirReparacion = id => {
		let ruta = `${direccion}/informes/reparacions/${id}/imprimir`
		imprimir(ruta)
	}
</script>
@endsection