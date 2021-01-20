<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{ asset('img/users/'.auth()->user()->tecnico->foto) }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{ auth()->user()->tecnico->nombre }}</p>
      <!-- Status -->
      <a href="{{ route('users.perfil') }}"><i class="fa fa-circle text-success"></i> En linea</a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU PRINCIPAL</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="{{ active('home') }}">
      <a href="{{ url('/home') }}">
        <i class="fa fa-dashboard"></i> <span>PANEL DE CONTROL</span>
      </a>
    </li>
    @canatleast(['tickets.index'])
    <li class="treeview {{ active('tickets/*') }}">
      <a href="#"><i class="fa fa-tags"></i> <span>TICKETS</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
        @if(auth()->user()->isRole('admin') || auth()->user()->isRole('encargado') || auth()->user()->isRole('externos') || auth()->user()->isRole('supervisor') )
        @can('tickets.index')
        <li class="{{ active('tickets/recepcionados') }}">
          <a href="{{ route('tickets.index','recepcionados') }}">
            <i class="fa fa-circle-o text-red"></i> RECEPCIONADOS
          </a>
        </li>
        @endcan
        @endif
        @can('tickets.index')
        <li class="{{ active('tickets/asignados') }}">
          <a href="{{ route('tickets.index','asignados') }}">
            <i class="fa fa-circle-o text-teal"></i> ASIGNADOS
          </a>
        </li>
        @endcan
        @can('tickets.index')
        <li class="{{ active('tickets/finalizados') }}">
          <a href="{{ route('tickets.index','finalizados') }}">
            <i class="fa fa-circle-o text-green"></i> FINALIZADOS
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endcanatleast
    @canatleast(['bajas.index','recepcions.index','reposicions.index','reparacions.index','externos.index'])
    <li class="treeview {{ active('informes/*') }}">
      <a href="#"><i class="fa fa-file"></i> <span>INFORMES</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
        @can('recepcions.index')
        <li class="{{ active('informes/recepcions') }}">
          <a href="{{ route('recepcions.index') }}">
            <i class="fa fa-file-text"></i> RECEPCION
          </a>
        </li>
        @endcan
        @can('reparacions.index')
        <li class="{{ active('informes/reparacions') }}">
          <a href="{{ route('reparacions.index') }}">
            <i class="fa fa-wrench"></i> REPARACION
          </a>
        </li>
        @endcan
        @can('reposicions.index')
        <li class="{{ active('informes/reposicions') }}">
          <a href="{{ route('reposicions.index') }}">
            <i class="fa fa-cogs"></i> REPOSICION
          </a>
        </li>
        @endcan
        @can('bajas.index')
        <li class="{{ active('informes/bajas') }}">
          <a href="{{ route('bajas.index') }}">
            <i class="fa fa-arrow-circle-down"></i> BAJA
          </a>
        </li>
        @endcan
        @can('externos.index')
        <li class="{{ active('informes/externos') }}">
          <a href="{{ route('externos.index') }}">
            <i class="fa fa-external-link"></i> EXTERNOS
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endcanatleast
    @canatleast(['reportes.index','reportes.personalizado'])
    <li class="treeview {{ active('reportes/*') }}">
      <a href="#"><i class="fa fa-pie-chart"></i> <span>REPORTES</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
        @can('reportes.index')
        <li class="{{ active('reportes/estadisticos') }}">
          <a href="{{ route('reportes.index') }}">
            <i class="fa fa-bar-chart"></i> ESTADISTICOS
          </a>
        </li>
        @endcan
        @can('reportes.personalizado')
        <li class="{{ active('reportes/informes') }}">
          <a href="{{ route('reportes.informes') }}">
            <i class="fa fa-calendar"></i> INFORMES TECNICOS
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endcanatleast
    @can('direccions.index')
    <li class="{{ active('direccions') }}">
      <a href="{{ route('direccions.index') }}">
        <i class="fa fa-wifi"></i> <span>DIRECCIONES IP's</span>
      </a>
    </li>
    @endcan
    @canatleast(['componentes.index','unidads.index','diagnosticos.index','servicios.index','users.index','roles.index'])
    <li class="treeview {{ active('configuraciones/*') }}">
      <a href="#"><i class="fa fa-cogs"></i> <span>CONFIGURACIONES</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
        @can('componentes.index')
        <li class="{{ active('configuraciones/componentes') }}">
          <a href="{{ route('componentes.index') }}">
            <i class="fa fa-cubes"></i> COMPONENTES
          </a>
        </li>
        @endcan
        @can('unidads.index')
        <li class="{{ active('configuraciones/unidads') }}">
          <a href="{{ route('unidads.index') }}">
            <i class="fa fa-building"></i> UNIDADES
          </a>
        </li>
        @endcan
        @can('diagnosticos.index')
        <li class="{{ active('configuraciones/diagnosticos') }}">
          <a href="{{ route('diagnosticos.index') }}">
            <i class="fa fa-wrench"></i> DIAGNOSTICOS
          </a>
        </li>
        @endcan
        @can('servicios.index')
        <li class="{{ active('configuraciones/servicios') }}">
          <a href="{{ route('servicios.index') }}">
            <i class="fa fa-bug"></i> SERVICIOS
          </a>
        </li>
        @endcan
        @can('users.index')
        <li class="{{ active('configuraciones/users') }}">
          <a href="{{ route('users.index') }}">
            <i class="fa fa-users"></i> USUARIOS
          </a>
        </li>
        @endcan
        @can('roles.index')
        <li class="{{ active('configuraciones/roles') }}">
          <a href="{{ route('roles.index') }}">
            <i class="fa fa-server"></i> ROLES
          </a>
        </li>
        @endcan
      </ul>
    </li>
    @endcanatleast
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->