@canatleast(['bajas.edit','bajas.destroy','bajas.create','bajas.imprimir','bajas.cambiarFecha'])
<div class="btn-group">
	<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
  	<ul class="dropdown-menu dropdown-menu-right" role="menu">
  		@can('bajas.create')
  		<li>
    		<a href="{{ route('bajas.partir',$id) }}"><i class="fa fa-external-link"></i> A partir de</a>
    	</li>
    	@endcan
  		@can('bajas.edit')
    	<li>
    		<a href="{{ route('bajas.edit',$id) }}"><i class="fa fa-edit"></i> Editar</a>
    	</li>
    	@endcan
    	@can('bajas.imprimir')
    	<li>
    		<a href="javascript:void(0);" onclick="imprimirBaja({{ $id }});return false;"><i class="fa fa-print"></i> Imprimir</a>
    	</li>
    	@endcan
    	@can('bajas.destroy')
    	<li>
			<a href="javascript:void(0);" onclick="eliminarBaja({{ $id }}); return false;"><i class="fa fa-trash"></i> Eliminar</a>
		</li>
		@endcan
		@can('bajas.cambiarFecha')
    	<li>
    		<a href="{{ route('bajas.cambiarFecha',$id) }}"><i class="fa fa-calendar"></i> Cambiar Fecha</a>
    	</li>
    	@endcan
  	</ul>
</div>
@endcanatleast