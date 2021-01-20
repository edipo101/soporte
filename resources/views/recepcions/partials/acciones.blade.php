@canatleast(['recepcions.edit','recepcions.destroy','recepcions.create','recepcions.imprimir','recepcions.cambiarFecha'])
<div class="btn-group">
	<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
  	<ul class="dropdown-menu dropdown-menu-right" role="menu">
  		@can('recepcions.create')
  		<li>
    		<a href="{{ route('recepcions.partir',$id) }}"><i class="fa fa-external-link"></i> A partir de</a>
    	</li>
    	@endcan
  		@can('recepcions.edit')
    	<li>
    		<a href="{{ route('recepcions.edit',$id) }}"><i class="fa fa-edit"></i> Editar</a>
    	</li>
    	@endcan
    	@can('recepcions.imprimir')
    	<li>
    		<a href="javascript:void(0);" onclick="imprimirRecepcion({{ $id }});return false;"><i class="fa fa-print"></i> Imprimir</a>
    	</li>
    	@endcan
    	@can('recepcions.destroy')
    	<li>
    		<a href="javascript:void(0);" onclick="eliminarRecepcion({{ $id }});return false;"><i class="fa fa-trash"></i> Eliminar</a>
    	</li>
    	@endcan
    	@can('recepcions.cambiarFecha')
    	<li>
    		<a href="{{ route('recepcions.cambiarFecha',$id) }}"><i class="fa fa-calendar"></i> Cambiar Fecha</a>
    	</li>
    	@endcan
  	</ul>
</div>
@endcanatleast