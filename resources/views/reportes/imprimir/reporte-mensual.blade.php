<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Reporte Mensual</title>
    <link rel="stylesheet" href="css/impresion.css">
</head>
<body>
	<table id="header">
		<tr>
			<td width="15%" rowspan="3" class="center">
				<img src="img/logo.jpg" width='100px' id="logos">
			</td>
			<td width="70%" class="center">
				<h1>GOBIERNO AUTONOMO MUNICIPAL DE SUCRE</h1>
			</td>
			<td width="15%" rowspan="3" class="center">
				<strong class="ticket">{{ $usuarionombre }}</strong>
				<strong class="ticket">Tecnico de Sistemas</strong>
			</td>
		</tr>
		<tr>
			<td class="center">
				<h1>REPORTE DEL MES: {{ Date::now()->month($mes)->format('F') }} </h1>
			</td>
		</tr>
		<tr>
			<td class="center">
				<h1>JEFATURA DE TECNOLOGIAS DE LA INFORMACION</h1>
			</td>
		</tr>
    </table>
    {{-- aqui va a condicion --}}
    @if($tipo=='todos')
	<table class="detalle">
		<tr>
			<td class="center">
				<strong>INFOMES TECNICOS DE RECEPCION</strong>
			</td>
		</tr>
	</table>
	@if($informes_recepcion->count() > 0)
	<table class="detalle">
		<tr class="detalle_titulos">
			<th>Fecha Informe</th>
			<th>Informe</th>
			<th>Ticket</th>
			<th>Unidad</th>
			<th>Solicitado por</th>
			<th>Componente</th>
			<th>Asunto</th>
		</tr>
		@foreach($informes_recepcion as $recepcion)
		<tr>
			<td>{{ $recepcion->created_at->format('d/m/Y') }}</td>
			<td>{{ $recepcion->id ."/". $recepcion->gestion }}</td>
			<td>{{ $recepcion->ticket->fullticket }}</td>
			<td>{{ $recepcion->ticket->unidad->nombre }}</td>
			<td>{{ $recepcion->ticket->solicitante }}</td>
			<td>{{ $recepcion->ticket->componente->nombre }}</td>
			<td>{{ $recepcion->asunto }}</td>
		</tr>
		@endforeach
	</table>
	@else
	<table class="detalle">
		<tr class="detalle_titulos">
			<td class="center">
				<br>
				<strong>NO REALIZO NINGUN INFORME DE RECEPCION</strong>
				<br> <br>
			</td>
		</tr>
	</table>
	@endif
	<table class="detalle">
		<tr>
			<td class="center">
				<strong>INFOMES TECNICOS DE REPARACION</strong>
			</td>
		</tr>
	</table>
	@if($informes_reparacion->count() > 0)
	<table class="detalle">
		<tr class="detalle_titulos">
			<th>Fecha Informe</th>
			<th>Informe</th>
			<th>Ticket</th>
			<th>Unidad</th>
			<th>Solicitado por</th>
			<th>Componente</th>
			<th>Asunto</th>
		</tr>
		@foreach($informes_reparacion as $reparacion)
		<tr>
			<td>{{ $reparacion->created_at->format('d/m/Y') }}</td>
			<td>{{ $reparacion->id ."/". $reparacion->gestion }}</td>
			<td>{{ $reparacion->ticket->fullticket }}</td>
			<td>{{ $reparacion->ticket->unidad->nombre }}</td>
			<td>{{ $reparacion->ticket->solicitante }}</td>
			<td>{{ $reparacion->ticket->componente->nombre }}</td>
			<td>{{ $reparacion->asunto }}</td>
		</tr>
		@endforeach
	</table>
	@else
	<table class="detalle">
		<tr class="detalle_titulos">
			<td class="center">
				<br>
				<strong>NO REALIZO NINGUN INFORME DE REPARACION</strong>
				<br> <br>
			</td>
		</tr>
	</table>
	@endif
	<table class="detalle">
		<tr>
			<td class="center">
				<strong>INFOMES TECNICOS DE REPOSICION</strong>
			</td>
		</tr>
	</table>
	@if($informes_reposicion->count() > 0)
	<table class="detalle">
		<tr class="detalle_titulos">
			<th>Fecha Informe</th>
			<th>Informe</th>
			<th>Ticket</th>
			<th>Unidad</th>
			<th>Solicitado por</th>
			<th>Componente</th>
			<th>Asunto</th>
		</tr>
		@foreach($informes_reposicion as $reposicion)
		<tr>
			<td>{{ $reposicion->created_at->format('d/m/Y') }}</td>
			<td>{{ $reposicion->id ."/". $reposicion->gestion }}</td>
			<td>{{ $reposicion->ticket->fullticket }}</td>
			<td>{{ $reposicion->ticket->unidad->nombre }}</td>
			<td>{{ $reposicion->ticket->solicitante }}</td>
			<td>{{ $reposicion->ticket->componente->nombre }}</td>
			<td>{{ $reposicion->asunto }}</td>
		</tr>
		@endforeach
	</table>
	@else
	<table class="detalle">
		<tr class="detalle_titulos">
			<td class="center">
				<br>
				<strong>NO REALIZO NINGUN INFORME DE REPOSICION</strong>
				<br> <br>
			</td>
		</tr>
	</table>
	@endif

	<table class="detalle">
		<tr>
			<td class="center">
				<strong>INFOMES TECNICOS DE BAJA</strong>
			</td>
		</tr>
	</table>
	@if($informes_baja->count() > 0)
	<table class="detalle">
		<tr class="detalle_titulos">
			<th>Fecha Informe</th>
			<th>Informe</th>
			<th>Ticket</th>
			<th>Unidad</th>
			<th>Solicitado por</th>
			<th>Componente</th>
			<th>Asunto</th>
		</tr>
		@foreach($informes_baja as $baja)
		<tr>
			<td>{{ $baja->created_at->format('d/m/Y') }}</td>
			<td>{{ $baja->id ."/". $baja->gestion }}</td>
			<td>{{ $baja->ticket->fullticket }}</td>
			<td>{{ $baja->ticket->unidad->nombre }}</td>
			<td>{{ $baja->ticket->solicitante }}</td>
			<td>{{ $baja->ticket->componente->nombre }}</td>
			<td>{{ $baja->asunto }}</td>
		</tr>
		@endforeach
	</table>
	@else
	<table class="detalle">
		<tr class="detalle_titulos">
			<td class="center">
				<br>
				<strong>NO REALIZO NINGUN INFORME DE BAJA</strong>
				<br> <br>
			</td>
		</tr>
	</table>
    @endif

	<table class="detalle">
		<tr>
			<td class="center">
				<strong>INFOMES TECNICOS EXTERNOS</strong>
			</td>
		</tr>
	</table>
	@if($informes_externo->count() > 0)
	<table class="detalle">
		<tr class="detalle_titulos">
			<th>Nombre</th>
			<th>Unidad</th>			
			<th>Fecha de Elaboración</th>
			<th>Fecha de Entrega</th>				
		</tr>
		@foreach($informes_externo as $externo)
		<tr>			
			<td>{{ $externo->nombre }}</td>
			<td>{{ $externo->unidad->nombre }}</td>
			<td>{{ $externo->fecha_elaboracion->format('d/m/Y') }}</td>
			<td>{{ $externo->fecha_entrega->format('d/m/Y') }}</td>					
		</tr>
		@endforeach
	</table>
	@else
	<table class="detalle">
		<tr class="detalle_titulos">
			<td class="center">
				<br>
				<strong>NO REALIZO NINGUN INFORME EXTERNO</strong>
				<br> <br>
			</td>
		</tr>
	</table>
    @endif



	@elseif($tipo=='externos')
	<table class="detalle">
		<tr>
			<td class="center">
				<strong>INFORMES TECNICOS EXTERNOS</strong>
			</td>
		</tr>
	</table>	
	<table class="detalle">
		<tr class="detalle_titulos">
			<th>Nombre</th>
			<th>Unidad</th>			
			<th>Fecha de Elaboración</th>
			<th>Fecha de Entrega</th>				
		</tr>
		@foreach($informes as $externo)
		<tr>			
			<td>{{ $externo->nombre }}</td>
			<td>{{ $externo->unidad->nombre }}</td>
			<td>{{ $externo->fecha_elaboracion->format('d/m/Y') }}</td>
			<td>{{ $externo->fecha_entrega->format('d/m/Y') }}</td>					
		</tr>
		@endforeach
	</table>

	
    @else
    <table class="detalle">
		<tr class="detalle_titulos">
			<th>Fecha Informe</th>
			<th>Informe</th>
			<th>Ticket</th>
			<th>Unidad</th>
			<th>Solicitado por</th>
			<th>Componente</th>
			<th>Asunto</th>
		</tr>
		@foreach($informes as $informe)
		<tr>
			<td>{{ $informe->fecha_informe->format('d/m/Y') }}</td>
			<td>{{ $informe->id ."/". $informe->gestion }}</td>
			<td>{{ $informe->ticket->fullticket }}</td>
			<td>{{ $informe->ticket->unidad->nombre }}</td>
			<td>{{ $informe->ticket->solicitante }}</td>
			<td>{{ $informe->ticket->componente->nombre }}</td>
			<td>{{ $informe->asunto }}</td>
		</tr>
		@endforeach
	</table>
    @endif

	<table width="100%" class="fecha">
		<tr>
			<td colspan="5" class="right">Fecha de impresión: {{Carbon\Carbon::now()->format('d/m/Y g:i:s a')}}</td>
		</tr>
		<tr>
			<td colspan="5" class="right">Sistema desarrolladp por la <strong>Jefatura de Tecnologías de la Información</strong></td>
		</tr>
	</table>
	<br>
	
</body>
</html>