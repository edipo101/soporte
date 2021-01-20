@canatleast(['tickets.edit','tickets.destroy','tickets.create','tickets.imprimir'])<div class="btn-group">
	<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
  	<ul class="dropdown-menu dropdown-menu-right" role="menu">
    	@can('tickets.informe')
    	@if($estado =='A')
    	<li>
    		<a href="" data-target="#modal-informe-{{ $id }}" data-toggle="modal"><i class="fa fa-file"></i> Informe</a>
    	</li>
    	@endif
    	@endcan
    	@can('tickets.imprimir')
    	<li>
    		<a href="javascript:void(0);" onclick="imprimirTicket({{ $id }});return false;"><i class="fa fa-print"></i> Imprimir</a>
    	</li>
    	@endcan
    	@if($estado == 'R')
    	@can('tickets.edit')
    	<li>
    		<a href="{{ route('tickets.edit',$id) }}"><i class="fa fa-edit"></i> Editar</a>
    	</li>
    	@endcan
    	@endif
    	@if($estado != 'F')
    	@can('tickets.asignar')
    	<li>
    		<a href="{{ route('tickets.asignar',$id) }}"><i class="fa fa-mail-forward"></i> Asignar</a>
    	</li>
    	@endcan
    	@endif
    	@if($estado != 'F')
    	@can('tickets.destroy')
    	<li>
    		<a href="javascript:void(0);" onclick="eliminarTicket({{ $id }});return false;"><i class="fa fa-trash"></i> Anular</a>
    	</li>
    	@endcan
    	@endif
  	</ul>
</div>
@endcanatleast
@include('tickets.partials.modal-informe')