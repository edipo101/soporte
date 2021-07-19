<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Informe Tecnico de Baja | {{ $baja->nro_informe }}  </title>
<link rel="stylesheet" href="css/informes.css">
</head>
<body>
	@if($baja->funcionario_id != null)
		<table id="header">
			<tr>
				<td width="15%" rowspan="3" class="center">
					<img src="img/logo.png" width='125px' id="logos" alt="Logo GAMS">
				</td>
				<td width="70%" class="center">
					<h1>GOBIERNO AUTÓNOMO MUNICIPAL DE SUCRE</h1>
				</td>
				<td width="15%" rowspan="3" class="center">
					<p>
						<strong>Fecha de solicitud:</strong>
						{{-- {{ Carbon\Carbon::now()->format('d/m/Y') }} --}}
						{{ $baja->fecha_solicitud->format('d/m/Y') }}
					</p>
					<p>
						{{-- <strong>Usuario:</strong><br>
						{{ Auth::user()->nickname }} --}}
					</p>
				</td>
			</tr>
			<tr>
				<td class="center">
					<h1>SOPORTE TÉCNICO</h1>
				</td>
			</tr>
			<tr>
				<td class="center">
					<h1>CAMBIO DE FECHA INFORME DE BAJA</h1>
				</td>
			</tr>
		</table>
		<table class="solicitud">
			<tr>
				<td><strong>SOLICITUD DE CAMBIO DE FECHA</strong></td>
			</tr>
		</table>
		<div id="caracteristicas-solicitud">
			<p class="titulos">EL FUNCIONARIO(A) <strong>{{ $baja->funcionario->nombre }} {{ $baja->funcionario->apellidos }}</strong> CON <strong>CI:{{ $baja->funcionario->carnet }}{{ $baja->funcionario->exp }}</strong> QUE TIENE EL CARGO DE <strong>{{ $baja->funcionario->cargo }}</strong>, SOLICITO EL CAMBIO DE FECHA DEL INFORME NRO {{ $baja->nro_informe }}. {{ $baja->observacion_fecha }} 
			</p>
		</div>
		<table id="firmas">
			<tr>
				<td width="30%" rowspan="2">&nbsp;</td>
				<td width="35%" rowspan="2">&nbsp;</td>
				<td width="15%" class="titulos right">&nbsp;</td>
				<td width="20%">&nbsp;</td>
			</tr>
			<tr>
				<td class="titulos right">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
	
			<tr>
				<td>&nbsp;</td>
				<td class="linea2">{{ $baja->funcionario->nombre }} {{ $baja->funcionario->apellidos }}</td>
				<td class="titulos right">&nbsp;</td>
			</tr>
			<tr>
				<td class="titulos">&nbsp;</td>
				<td class="titulos">{{ $baja->funcionario->cargo }}</td>
				
			</tr>
		</table>
		<table id="codigo">
			<tr>
				<td>
					<img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(300)->generate($baja->funcionario->nombre.' '.$baja->funcionario->apellidos.' | '.$baja->funcionario->carnet.''.$baja->funcionario->exp.' | '.$baja->funcionario->cargo.' | Fecha Solicitud:'.$baja->fecha_solicitud)) }} ">
					<p>Código de Verificación</p>
				</td>
			</tr>
		</table>
		<br><br>
		<table id="header">
			<tr>
				<td width="15%" rowspan="3" class="center">
					<img src="img/logo.png" width='125px' id="logos" alt="Logo GAMS">
				</td>
				<td width="70%" class="center">
					<h1>GOBIERNO AUTÓNOMO MUNICIPAL DE SUCRE</h1>
				</td>
				<td width="15%" rowspan="3" class="center">
					<p>
						<strong>Fecha de solicitud:</strong>
						{{-- {{ Carbon\Carbon::now()->format('d/m/Y') }} --}}
						{{ $baja->fecha_solicitud->format('d/m/Y') }}
					</p>
					<p>
						{{-- <strong>Usuario:</strong><br>
						{{ Auth::user()->nickname }} --}}
					</p>
				</td>
			</tr>
			<tr>
				<td class="center">
					<h1>SOPORTE TÉCNICO</h1>
				</td>
			</tr>
			<tr>
				<td class="center">
					<h1>CAMBIO DE FECHA INFORME DE BAJA</h1>
				</td>
			</tr>
		</table>
		<table class="solicitud">
			<tr>
				<td><strong>SOLICITUD DE CAMBIO DE FECHA</strong></td>
			</tr>
		</table>
		<div id="caracteristicas-solicitud">
			<p class="titulos">EL FUNCIONARIO(A) <strong>{{ $baja->funcionario->nombre }} {{ $baja->funcionario->apellidos }}</strong> CON <strong>CI:{{ $baja->funcionario->carnet }}{{ $baja->funcionario->exp }}</strong> QUE TIENE EL CARGO DE <strong>{{ $baja->funcionario->cargo }}</strong>, SOLICITO EL CAMBIO DE FECHA DEL INFORME NRO {{ $baja->nro_informe }}. {{ $baja->observacion_fecha }} 
			</p>
		</div>
		<table id="firmas">
			<tr>
				<td width="30%" rowspan="2">&nbsp;</td>
				<td width="35%" rowspan="2">&nbsp;</td>
				<td width="15%" class="titulos right">&nbsp;</td>
				<td width="20%">&nbsp;</td>
			</tr>
			<tr>
				<td class="titulos right">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
	
			<tr>
				<td>&nbsp;</td>
				<td class="linea2">{{ $baja->funcionario->nombre }} {{ $baja->funcionario->apellidos }}</td>
				<td class="titulos right">&nbsp;</td>
			</tr>
			<tr>
				<td class="titulos">&nbsp;</td>
				<td class="titulos">{{ $baja->funcionario->cargo }}</td>
				
			</tr>
		</table>
		<table id="codigo">
			<tr>
				<td>
					<img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(300)->generate($baja->funcionario->nombre.' '.$baja->funcionario->apellidos.' | '.$baja->funcionario->carnet.''.$baja->funcionario->exp.' | '.$baja->funcionario->cargo.' | Fecha Solicitud:'.$baja->fecha_solicitud)) }} ">
					<p>Código de Verificación</p>
				</td>
			</tr>
		</table>
		<div class="page-break"></div>
	@endif
	<table id="header">
		<tr>
			<td width="15%" rowspan="3" class="center">
				<img src="img/logo.png" width='125px' id="logos" alt="Logo GAMS">
			</td>
			<td width="70%" class="center">
				<h1>GOBIERNO AUTÓNOMO MUNICIPAL DE SUCRE</h1>
			</td>
			<td width="15%" rowspan="3" class="center">
				<p>
					<strong>Fecha de emisión:</strong>
					{{ Carbon\Carbon::now()->format('d/m/Y') }}
				</p>
				<p>
					<strong>Usuario:</strong><br>
					{{ Auth::user()->nickname }}
				</p>
			</td>
		</tr>
		<tr>
			<td class="center">
				<h1>SOPORTE TÉCNICO</h1>
			</td>
		</tr>
		<tr>
			<td class="center">
				<h1>INFORME TÉCNICO DE BAJA</h1>
			</td>
		</tr>
    </table>
    
	<table id="detalle">
		<tr>
			<td>INFORME TÉCNICO</td>
		</tr>
		<tr>
			<td>{{ "Nro. ". $baja->nro_informe  }}</td>
		</tr>
	</table>

	<table id="informacion">
		<tr>
			<td class="titulos" width="10%">Fecha:</td>
			<td width="60%">Sucre, {{ $baja->fecha_informe->format('j \\d\\e F \\d\\e\\l Y') }}</td>
			{{-- <td width="60%">Sucre, {{ $baja->created_at->format('d/m/Y') }}</td> --}}
			<td class="ticket" width="30%">Número de Ticket</td>
		</tr>
		<tr>
			<td class="titulos">Para:</td>
			<td>Sr(a): {{ $baja->ticket->solicitante }}</td>
			<td class="ticket" rowspan="3"><span>{{ $baja->ticket->nro_ticket }}/{{ $baja->ticket->gestion }}</span></td>
		</tr>
		<tr>
			<td></td>
			<td class="titulos">{{ $baja->ticket->unidad->nombre }}</td>
		</tr>
		<tr>
			<td class="titulos">De</td>
			<td>{{ $baja->user->tecnico->titulo }} {{ $baja->user->tecnico->fullnombre }}</td>
			{{-- <td class="ticket">Fecha de Ingreso</td> --}}
		</tr>
		<tr>
			<td></td>
			<td class="titulos">{{ $baja->user->tecnico->cargo }}</td>
			{{-- <td class="ticket">{{ $baja->ticket->created_at->format('d/m/Y') }}</td> --}}
		</tr>
		<tr>
			<td class="titulos">Asunto:</td>
			<td colspan="2">{{ $baja->asunto }}</td>
		</tr>
	</table>

	<table id="informe">
		<tr>
			<td>De mi mayor consideración:</td>
		</tr>
		<tr>
			<td>En cumplimiento a su solicitud de Soporte Técnico de un equipo informático, de su dependencia se informa los siguiente:</td>
		</tr>
	</table>
	<table id="componente">
		<tr>
			<td width="10%" class="titulos">Componente: </td>
			<td>{{ $baja->ticket->componente->nombre }}</td>
		</tr>
	</table>
	<hr>
	<table id="caracteristicas">
		<tr>
			<td class="titulos">Caracteristicas</td>
		</tr>
		<tr>
			<td class="detalles">{!! $baja->caracteristicas !!}</td>
		</tr>
	</table>

	<table id="diagnostico">
		<tr>
			<td class="titulos">Diagnóstico</td>
		</tr>
		<tr>
			<td class="detalles">{!! $baja->diagnostico !!}</td>
		</tr>
	</table>
	<table id="trabajo">
		<tr>
			<td class="titulos">Trabajo Realizado</td>
		</tr>
		<tr>
			<td class="detalles">{!! $baja->trabajo_realizado !!}</td>
		</tr>
	</table>
	<table id="recomendaciones">
		<tr>
			<td class="titulos">Recomendaciones</td>
		</tr>
		<tr>
			<td class="detalles">{!! $baja->recomendaciones !!}</td>
		</tr>
	</table>

	<table id="aclaracion">
		<tr>
			<td>En cuanto informo para fines consiguientes.</td>
		</tr>
	</table>
	<table id="firmas">
		<tr>
			<td width="30%" rowspan="2">&nbsp;</td>
			<td width="35%" rowspan="2">&nbsp;</td>
			<td width="15%" class="titulos right">Recibido</td>
			<td width="20%">&nbsp;</td>
		</tr>
		<tr>
			<td class="titulos right">Firma</td>
			<td class="linea">&nbsp;</td>
		</tr>

		<tr>
			<td class="linea2">{{ $baja->user->tecnico->titulo }} {{ $baja->user->tecnico->fullnombre }}</td>
			<td></td>
			<td class="titulos right">Nombres</td>
			<td class="linea">&nbsp;</td>
		</tr>
		<tr>
			<td class="titulos">{{ $baja->user->tecnico->cargo }}</td>
			<td class="titulos">Vo.Bo.</td>
			<td class="titulos right">Cargo</td>
			<td class="linea">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="titulos right">Fecha de Recojo</td>
			<td class="linea">&nbsp;</td>
		</tr>
	</table>

	<table id="codigo">
		<tr>
			<td>
				<img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(300)->generate($baja->autentificacion)) }} ">
				<p>Código de Verificación</p>
			</td>
		</tr>
	</table>

	<table width="100%" id="fecha">
		<tr>
			<td colspan="5">Fecha impresa: {{Carbon\Carbon::now()->format('d/m/Y h:i:s a')}}</td>
		</tr>
		<tr>
			<td colspan="5">Sistema realizado por la <strong>Jefatura de Tecnologías de la Información</strong> - Área de Desarrollo de Sistemas</td>
		</tr>
	</table>

	{{-- Here's the magic. This MUST be inside body tag. Page count / total, centered at bottom of page --}}
	<script type="text/php">
		if (isset($pdf)) {
			$text = "Página {PAGE_NUM} / {PAGE_COUNT}";
			$size = 8;
			$font = $fontMetrics->getFont("Arial");
			$width = $fontMetrics->get_text_width($text, $font, $size) / 2;
			$x = ($pdf->get_width() - $width) / 2;
			$y = $pdf->get_height() - 35;
			$pdf->page_text($x, $y, $text, $font, $size);
		}
	</script>
</body>
</html>