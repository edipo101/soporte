@extends('layouts.app')

@section('title')
    Panel de Control
@endsection

@section('head-content')
    <h1>
        <i class="fa fa-dashboard"></i> SISTEMA DE SOPORTE TECNICO
        <small>Panel de Control del Sistema</small>
    </h1>
@endsection

@section('main-content')
<div class="row">
	@if(auth()->user()->isRole('admin') || auth()->user()->isRole('encargado') || auth()->user()->isRole('externos') || auth()->user()->isRole('supervisor') )
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="info-box">
    		<span class="info-box-icon bg-red"><i class="fa fa-tags"></i></span>
      		<div class="info-box-content">
        		<span class="info-box-text">Tickets Recepcionados</span>
				<span class="info-box-number">{{ $tkrecepcion }} <small><i>(Gestión {{ $gestion }})</i></small></span>
				<a href="{{ route('tickets.index','recepcionados') }}" class="btn btn-link">VER DETALLES</a>
			</div>
			<!-- /.info-box-content -->
    	</div>
    	<!-- /.info-box -->
	</div>
	<!-- /.col -->
	@endif
	@can('tickets.index')  
  	<div class="col-md-3 col-sm-6 col-xs-12">
    	<div class="info-box">
      		<span class="info-box-icon bg-aqua"><i class="fa fa-tags"></i></span>
      		<div class="info-box-content">
        		<span class="info-box-text">Tickets Asignados</span>
        		<span class="info-box-number">{{ $tkasignacion }} <small><i>(Gestión {{ $gestion }})</i></small></span>
        		<a href="{{ route('tickets.index','asignados') }}" class="btn btn-link">VER DETALLES</a>
      		</div>
      		<!-- /.info-box-content -->
    	</div>
    	<!-- /.info-box -->
  	</div>
  	<!-- /.col -->
  	<!-- fix for small devices only -->
	<div class="clearfix visible-sm-block"></div>	  
	<div class="col-md-3 col-sm-6 col-xs-12">
    	<div class="info-box">
      		<span class="info-box-icon bg-green"><i class="fa fa-tags"></i></span>
      		<div class="info-box-content">
        		<span class="info-box-text">Tickets Finalizados</span>
        		<span class="info-box-number">{{ $tkfinalizado }} <small><i>(Gestión {{ $gestion }})</i></small></span>
        		<a href="{{ route('tickets.index','finalizados') }}" class="btn btn-link">VER DETALLES</a>
      		</div>
      		<!-- /.info-box-content -->
    	</div>
    	<!-- /.info-box -->
  	</div>
	<!-- /.col -->
	@endcan
	@can('reportes.index')
	<div class="col-md-3 col-sm-6 col-xs-12">
    	<div class="info-box">
      		<span class="info-box-icon bg-yellow"><i class="fa fa-pie-chart"></i></span>
      		<div class="info-box-content">
        		<span class="info-box-text">Reportes</span>
        		<span class="info-box-number">Estadisticos</span>
        		<a href="{{ route('reportes.index') }}" class="btn btn-link">VER DETALLES</a>
      		</div>
      		<!-- /.info-box-content -->
    	</div>
    	<!-- /.info-box -->
	</div>
	@endcan
	
	@if(auth()->user()->isRole('tecnico'))
	@can('reportes.personalizado')
  	<div class="col-md-3 col-sm-6 col-xs-12">
    	<div class="info-box">
      		<span class="info-box-icon bg-yellow"><i class="fa fa-pie-chart"></i></span>
      		<div class="info-box-content">
        		<span class="info-box-text">Reportes</span>
        		<span class="info-box-number">Informes</span>
        		<a href="{{ route('reportes.informes') }}" class="btn btn-link">VER DETALLES</a>
      		</div>
      		<!-- /.info-box-content -->
    	</div>
    	<!-- /.info-box -->
	</div>
	@endcan  
	@endif
</div>

<div class="row">
	<div class="col-md-8">
		@if( auth()->user()->isRole('encargado') || auth()->user()->isRole('admin'))
			@if( $chartjs!=null)
			<div>
				<h3>Tickets finalizados últimos 14 días</h3>
				{!! $chartjs->render() !!}
			</div>	
			@endif		
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-info-circle"></i> Personal disponible</h3>				
		  	</div>
			  <div class="box-body">
				<div class="row">					
					  @foreach($personal as $sp)   
					  @if( tiene_acceso($sp) )					                   							
					  <div class="col-md-3">
						<div class="pcard hovercard">
							<div class="cardheader">
			
							</div>
							<div class="avatar">
								<img alt="" src="{{ asset('img/users/'.$sp->tecnico->foto) }}">
							</div>
							<div class="info">
								<div class="title">
									<span>{{ $sp->tecnico->nombre }}</span>
								</div>
								<div class="desc"><b>Tickets asignados : </b>{{ $sp->tickets->where('estado','A')->count() }}</div>
								<div class="desc"><b>Tickets finalizados : </b>{{ $sp->tickets->where('estado','F')->count() }}</div>								
							</div>							
						</div>
					  </div>
					  @endif
					  @endforeach					
				  </div>
				  <div class="row">
					<h3 class="box-title"><i class="fa fa-info-circle"></i> Encargados de area</h3>				
					@foreach($encargados as $sp)   
					@if( tiene_acceso($sp) )					                   							
					<div class="col-md-3">
					  <div class="pcard hovercard">
						  <div class="cardheader">
		  
						  </div>
						  <div class="avatar">
							  <img alt="" src="{{ asset('img/users/'.$sp->tecnico->foto) }}">
						  </div>
						  <div class="info">
							  <div class="title">
								  <span>{{ $sp->tecnico->nombre }}</span>
							  </div>	
							  <div class="desc"><b>Encargado : </b>{{ slugTipoEncargado($sp) }}</div>
							  
							  <div class="desc"><b>Tickets finalizados : </b>{{ $sp->tickets->where('estado','F')->count() }}</div>								
						  </div>							
					  </div>
					</div>
					@endif
					@endforeach					
				  </div>
			</div>
		</div>		
		@else		
		<div class="box">
        	<div class="box-header with-border">
          		<h3 class="box-title"><i class="fa fa-info-circle"></i> Información de Institución</h3>
          		<div class="box-tools pull-right">
            		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              		<i class="fa fa-minus"></i></button>
          		</div>				
        	</div>
        	<div class="box-body">
          		<h1 class="lead text-center text-uppercase">
           			GOBIERNO AUTONOMO MUNICIPAL DE SUCRE
          		</h1>
          		<h3 class="lead text-center">
            		SOPORTE TECNICO
          		</h3>
          		<img src="{{ asset('img/logo.jpg') }}" alt="" class="center-block img-responsive">
          		<hr>
          		<p class="text-center lead">JEFATURA DE TECNOLOGIAS DE LA INFORMACION</p>
        	</div>
        	<!-- /.box-body -->
        	<div class="box-footer text-center">
				@can('direccions.index')
	        	<a href="{{ route('direccions.index') }}" class="btn btn-app bg-blue">
                	<i class="fa fa-wifi"></i> Direcciones IPs
				</a>
				@endcan
                @can('unidads.index')
              	<a href="{{ route('unidads.index') }}" class="btn btn-app bg-yellow">
                	<i class="fa fa-building"></i> Unidades
              	</a>
                @endcan
                @can('componentes.index')
              	<a href="{{ route('componentes.index') }}" class="btn btn-app bg-red">
                	<i class="fa fa-cubes"></i> Componentes
              	</a>
                @endcan
                @can('users.perfil')
              	<a href="{{ route('users.perfil') }}" class="btn btn-app bg-green">
                	<i class="fa fa-user"></i> Perfil
              	</a>
                @endcan
	        </div>
      	</div>
		@endif
    	

  	</div>
  	<div class="col-md-4">
		@can('recepcions.index')
  		<!-- Info Boxes Style 2 -->
        <div class="info-box">
			<span class="info-box-icon bg-teal"><i class="fa fa-file-text"></i></span>
			
            <div class="info-box-content">
            	<span class="info-box-text">INF. RECEPCION</span>
              	<span class="info-box-number">{{ $recepcions }} <small><i>(Gestión {{ $gestion }})</i></small></span>
              	<a href="{{ route('recepcions.index') }}" class="btn btn-link">VER DETALLES</a>
            </div>
            <!-- /.info-box-content -->
		</div>
		@endcan
		@can('reparacions.index')
        <!-- Info Boxes Style 2 -->
        <div class="info-box">
        	<span class="info-box-icon bg-green"><i class="fa fa-wrench"></i></span>

            <div class="info-box-content">
            	<span class="info-box-text">INF. REPARACION</span>
              	<span class="info-box-number">{{ $reparacions }} <small><i>(Gestión {{ $gestion }})</i></small></span>
              	<a href="{{ route('reparacions.index') }}" class="btn btn-link">VER DETALLES</a>
            </div>
            <!-- /.info-box-content -->
		</div>
		@endcan
		@can('reposicions.index')
        <!-- Info Boxes Style 2 -->
        <div class="info-box">
        	<span class="info-box-icon bg-yellow"><i class="fa fa-cogs"></i></span>

            <div class="info-box-content">
            	<span class="info-box-text">INF. REPOSICION</span>
              	<span class="info-box-number">{{ $reposicions }} <small><i>(Gestión {{ $gestion }})</i></small></span>
              	<a href="{{ route('reposicions.index') }}" class="btn btn-link">VER DETALLES</a>
            </div>
            <!-- /.info-box-content -->
		</div>
		@endcan
		@can('bajas.index')
        <!-- Info Boxes Style 2 -->
        <div class="info-box">
        	<span class="info-box-icon bg-red"><i class="fa fa-arrow-circle-down"></i></span>

            <div class="info-box-content">
            	<span class="info-box-text">INF. BAJA</span>
              	<span class="info-box-number">{{ $bajas }} <small><i>(Gestión {{ $gestion }})</i></small></span>
              	<a href="{{ route('bajas.index') }}" class="btn btn-link">VER DETALLES</a>
            </div>
            <!-- /.info-box-content -->
		</div>
		@endcan
		@can('externos.index')
        <!-- Info Boxes Style 2 -->
        <div class="info-box">
        	<span class="info-box-icon bg-navy"><i class="fa fa-external-link"></i></span>

            <div class="info-box-content">
            	<span class="info-box-text">INF. EXTERNOS</span>
              	<span class="info-box-number">{{ $externos }} <small><i>(Gestión {{ $gestion }})</i></small></span>
              	<a href="{{ route('externos.index') }}" class="btn btn-link">VER DETALLES</a>
            </div>
            <!-- /.info-box-content -->
		</div>
		@endcan
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

@endsection