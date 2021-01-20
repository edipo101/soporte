@canatleast(['direccions.edit','direccions.destroy','direccions.observado'])
<div class="btn-group">
	<button type="button" class="btn btn-default btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
		<ul class="dropdown-menu dropdown-menu-right" role="menu">
			@can('direccions.edit')
			<li>
				<a href="{{ route('direccions.edit',$id) }}"><i class="fa fa-edit"></i> Editar</a>
			</li>
			@endcan
			@if($estado=='N')
			@can('direccions.observado')
			<li>
				<a href="" data-target="#modal-observar-{{ $id }}" data-toggle="modal"><i class="fa fa-exclamation"></i> Observar</a>
			</li>
			@endcan
			@endif
			@if($estado=='O')
			<li>
				<a href="" data-target="#modal-observaciones-{{ $id }}" data-toggle="modal"><i class="fa fa-eye"></i> Ver observacion</a>
			</li>
			@endif
			@can('direccions.destroy')
			<li>
				<a href="javascript:void(0);" onclick="eliminarDireccion({{ $id }}); return false;"><i class="fa fa-trash"></i> Eliminar</a>
			</li>
			@endcan
		</ul>
</div>
@endcanatleast

@if($estado=='N')
	@include('direccions.partials.modal-observar')
@else
	@include('direccions.partials.modal-observaciones')
@endif