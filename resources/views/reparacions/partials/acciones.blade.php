@canatleast(['reparacions.edit','reparacions.destroy','reparacions.create','reparacions.imprimir','reparacions.cambiarFecha'])
<div class="btn-group">
	<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
  	<ul class="dropdown-menu dropdown-menu-right" role="menu">
  		@can('reparacions.create')
  		<li>
    		<a href="{{ route('reparacions.partir',$id) }}"><i class="fa fa-external-link"></i> A partir de</a>
    	</li>
    	@endcan
  		@can('reparacions.edit')
    	<li>
    		<a href="{{ route('reparacions.edit',$id) }}"><i class="fa fa-edit"></i> Editar</a>
    	</li>
    	@endcan
    	@can('reparacions.imprimir')
    	<li>
    		<a href="javascript:void(0);" onclick="imprimirReparacion({{ $id }});return false;"><i class="fa fa-print"></i> Imprimir</a>
    	</li>
    	@endcan
    	@can('reparacions.destroy')
    	<li>
    		<a href="javascript:void(0);" onclick="eliminarReparacion({{ $id }});return false;"><i class="fa fa-trash"></i> Eliminar</a>
    	</li>
		@endcan
		@can('reparacions.cambiarFecha')
    	<li>
    		<a href="{{ route('reparacions.cambiarFecha',$id) }}"><i class="fa fa-calendar"></i> Cambiar Fecha</a>
    	</li>
    	@endcan
  	</ul>
</div>
@endcanatleast