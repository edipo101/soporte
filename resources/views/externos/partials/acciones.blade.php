@canatleast(['externos.edit','externos.destroy'])
<div class="btn-group pull-right">
	<button type="button" class="btn btn-flat btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Acciones <span class="fa fa-caret-down"></span></button>
	<ul class="dropdown-menu">
		@can('externos.edit')
		<li><a href="{{ route('externos.edit',$id) }}"><i class="fa fa-edit"></i> Editar</a></li>
        @endcan
        @can('externos.imprimir')
		<li><a href="javascript:void(0);" onclick="imprimirExterno({{ $id }});return false;" ><i class="fa fa-print"></i> Imprimir</a></li>
		@endcan
		@can('externos.destroy')
		<li><a href="javascript:void(0);" onclick="eliminarExterno({{ $id }}); return false;"><i class="fa fa-trash"></i> Eliminar</a></li>
		@endcan
	</ul>
</div>
@endcanatleast