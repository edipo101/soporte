<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Ticket | {{ $ticket->id }}  </title>
<link rel="stylesheet" href="css/impresion.css">
</head>
<body>
	@for($i=1; $i<=2; $i++)
	<div class="volante-{{ $i }}">
		<table id="header">
			<tr>
				<td width="15%" rowspan="3" class="center">
					<img src="img/logo.png" width='100px' id="logos">
				</td>
				<td width="70%" class="center">
					<h1>GOBIERNO AUTÓNOMO MUNICIPAL DE SUCRE</h1>
				</td>
				<td width="15%" rowspan="3" class="center">
					<strong class="ticket">Ticket Nro: {{ $ticket->nro_ticket }}</strong><br>
					<strong class="ticket">Gestión: {{ $ticket->gestion }}</strong>
				</td>
			</tr>
			<tr>
				<td class="center">
					<h1>SOPORTE TÉCNICO</h1>
				</td>
			</tr>
			<tr>
				<td class="center">
					<h1>JEFATURA DE TECNOLOGÍAS DE LA INFORMACIÓN</h1>
				</td>
			</tr>
		</table>
		<table class="datos">
			<tr>
				<td><strong>UNIDAD SOLICITANTE: </strong></td>
				<td colspan="2">{{ $ticket->unidad->nombre }}</td>
			</tr>
			@if(!$ticket->solicitante=='')
			<tr>
				<td><strong>SOLICITUD POR: </strong></td>
				<td colspan="2">{{ $ticket->solicitante }}</td>
			</tr>
			@elseif(!$ticket->empresa=='')
			<tr>
				<td><strong>EMPRESA: </strong></td>
				<td colspan="2">{{ $ticket->empresa }}</td>
			</tr>
			@endif
			<tr>
				<td ><strong>FECHA RECEPCIONADA: </strong></td>
				<td>{{ $ticket->created_at->format('d/m/Y') }}</td>
				<td><strong>HORA RECEPCIONADA: </strong></td>
				<td>{{ $ticket->created_at->format('H:i:s') }}</td>
			</tr>
			<tr>
				<td ><strong>COMPONENTE: </strong></td>
				<td>{{ $ticket->componente->nombre }}</td>
				<td><strong>PRIORIDAD: </strong></td>
				<td>{{ $ticket->prioridad }}</td>
			</tr>
			<tr>
				<td ><strong>TELEFONO DE LA UNIDAD: </strong></td>
				<td>{{ $ticket->telef_referencia ? : "S/N"}}</td>
				<td><strong>CELULAR DE REFERENCIA: </strong></td>
				<td>{{ $ticket->celular_referencia ? : "S/N" }}</td>
			</tr>
			@if(!$ticket->empresa=='')
			<tr>
				<td colspan="2"><strong>SE ENTREGO LOS SIGUIENTES DOCUMENTOS: </strong></td>
				<td>
					{{ $ticket->factura=="E" ? "FACTURA": "SIN FACTURA" }}, 
					{{ $ticket->ordencompra=="E" ? "ORDEN DE COMPRA": "SIN ORDEN DE COMPRA" }}, 
					{{ $ticket->garantia=="E" ? "GARANTIA": "SIN GARANTIA" }}
				</td>
			</tr>
			@endif
		</table>
		<table class="detalle-diag">
			<tr>
				<td width="60%" class="diag">DIAGNOSTICO</td>
				<td width="40%" class="diag">OBSERVACIÓN</td>
			</tr>
			<tr>
				<td>
				@foreach($ticket->diagnosticos as $diagnostico)
					<p style="margin: 10px 0"><strong>{{ $diagnostico->nombre }}</strong> ({{ $diagnostico->descripcion }})</p>
				@endforeach
				</td>
				<td>
					{{ $ticket->observacion ? : "SIN OBSERVACIONES" }}
				</td>
			</tr>
		</table>

		<table class="firmas">
			<tr>
				<td class="sellos" width="50%"><br><br><br><br></td>
				<td class="sellos" width="50%"><br><br><br><br></td>
			</tr>
			<tr>
				<td>
					Recepcionado por <br>
					<strong>Jef. de Tecnologías de la Información</strong>
				</td>
				<td>
					<strong>
						Firma del Solicitante <br>
					</strong>
				</td>
			</tr>
		</table>

		<table width="100%" class="glosa">
			<tr>
				<td class="left espacio-left glosa_head">
					<strong>NOTA:</strong>
				</td>
				<td class="left espacio-left" colspan="4">
					<p>El equipo o dispositivo se entregara aproximadamente 48 horas despues de su designacion del ticket al respectivo Ténico de soporte, pasado el plazo se recomienda llamar a la unidad de Soporte Técnico.</p>
					<p>Se aclara que los días pueden variar dependiendo de la dificultad del equipo o dispositivo</p>
				</td>
				
			</tr>
			<tr>
				<td class="left espacio-left glosa_head">
					<strong>ACLARACIÓN:</strong>
				</td>
				<td class="left espacio-left" colspan="4">
					<p>La Jefatura de Tecnologías de la Información no se hace responsable del equipo o dispositivo dejado una vez pasado los días aproximados para su revisión</p>
				</td>
			</tr>
		</table>
		<table width="100%" class="fecha">
			<tr>
				<td colspan="5" class="right">Fecha de impresión: {{Carbon\Carbon::now()->format('d/m/Y g:i:s a')}}</td>
			</tr>
			<tr>
				<td colspan="5" class="right">Sistema desarrollado por la <strong>Jefatura de Tecnologías de la Información</strong></td>
			</tr>
		</table>
		
	</div>
	@if($i==1)
		<hr class="linea-division">
		@endif
	@endfor
	
		
</body>
</html>