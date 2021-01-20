@canatleast(['reposicions.edit','reposicions.destroy','reposicions.create','reposicions.imprimir','reposicions.cambiarFecha'])
<div class="btn-group">
	<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
  	<ul class="dropdown-menu dropdown-menu-right" role="menu">
  		@can('reposicions.create')
  		<li>
    		<a href="{{ route('reposicions.partir',$id) }}"><i class="fa fa-external-link"></i> A partir de</a>
    	</li>
    	@endcan
  		@can('reposicions.edit')
    	<li>
    		<a href="{{ route('reposicions.edit',$id) }}"><i class="fa fa-edit"></i> Editar</a>
    	</li>
    	@endcan
    	@can('reposicions.imprimir')
    	<li>
    		<a href="javascript:void(0);" onclick="imprimirReposicion({{ $id }});return false;"><i class="fa fa-print"></i> Imprimir</a>
    	</li>
    	@endcan
    	@can('reposicions.destroy')
    	<li>
    		<a href="javascript:void(0);" onclick="eliminarReposicion({{ $id }});return false;"><i class="fa fa-trash"></i> Eliminar</a>
    	</li>
		@endcan
		@can('reposicions.cambiarFecha')
    	<li>
    		<a href="{{ route('reposicions.cambiarFecha',$id) }}"><i class="fa fa-calendar"></i> Cambiar Fecha</a>
    	</li>
    	@endcan
  	</ul>
</div>
@endcanatleast