<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Informe Tecnico de Recepcion | {{ $recepcion->nro_informe }}  </title>
<link rel="stylesheet" href="css/informes.css">
</head>
<body>
	@if($recepcion->funcionario_id != null)
		<table id="header">
			<tr>
				<td width="15%" rowspan="3" class="center">
					<img src="img/logo.png" width='125px' id="logos" alt="GAMS">
				</td>
				<td width="70%" class="center">
					<h1>GOBIERNO AUTÓNOMO MUNICIPAL DE SUCRE</h1>
				</td>
				<td width="15%" rowspan="3" class="center">
					<p>
						<strong>Fecha de solicitud:</strong>
						{{-- {{ Carbon\Carbon::now()->format('d/m/Y') }} --}}
						{{ $recepcion->fecha_solicitud->format('d/m/Y') }}
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
					<h1>CAMBIO DE FECHA INFORME DE RECEPCION</h1>
				</td>
			</tr>
		</table>
		<table class="solicitud">
			<tr>
				<td><strong>SOLICITUD DE CAMBIO DE FECHA</strong></td>
			</tr>
		</table>
		<div id="caracteristicas-solicitud">
			<p class="titulos">EL FUNCIONARIO(A) <strong>{{ $recepcion->funcionario->nombre }} {{ $recepcion->funcionario->apellidos }}</strong> CON <strong>CI:{{ $recepcion->funcionario->carnet }}{{ $recepcion->funcionario->exp }}</strong> QUE TIENE EL CARGO DE <strong>{{ $recepcion->funcionario->cargo }}</strong>, SOLICITO EL CAMBIO DE FECHA DEL INFORME NRO {{ $recepcion->nro_informe }}. {{ $recepcion->observacion_fecha }} 
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
				<td class="linea2">{{ $recepcion->funcionario->nombre }} {{ $recepcion->funcionario->apellidos }}</td>
				<td class="titulos right">&nbsp;</td>
			</tr>
			<tr>
				<td class="titulos">&nbsp;</td>
				<td class="titulos">{{ $recepcion->funcionario->cargo }}</td>
				
			</tr>
		</table>
		<table id="codigo">
			<tr>
				<td>
					<img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(300)->margin(0)->generate($recepcion->funcionario->nombre.' '.$recepcion->funcionario->apellidos.' | '.$recepcion->funcionario->carnet.''.$recepcion->funcionario->exp.' | '.$recepcion->funcionario->cargo.' | Fecha Solicitud:'.$recepcion->fecha_solicitud)) }} ">
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
						{{ $recepcion->fecha_solicitud->format('d/m/Y') }}
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
					{{-- <h1>SOLICITUD DE CAMBIO DE FECHA</h1> --}}
				</td>
			</tr>
		</table>
		<table class="solicitud">
			<tr>
				<td><strong>SOLICITUD DE CAMBIO DE FECHA</strong></td>
			</tr>
		</table>
		<div id="caracteristicas-solicitud">
			<p class="titulos">EL FUNCIONARIO(A) <strong>{{ $recepcion->funcionario->nombre }} {{ $recepcion->funcionario->apellidos }}</strong> CON <strong>CI:{{ $recepcion->funcionario->carnet }}{{ $recepcion->funcionario->exp }}</strong> QUE TIENE EL CARGO DE <strong>{{ $recepcion->funcionario->cargo }}</strong>, SOLICITO EL CAMBIO DE FECHA DEL INFORME NRO {{ $recepcion->nro_informe }}. {{ $recepcion->observacion_fecha }} 
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
				<td class="linea2">{{ $recepcion->funcionario->nombre }} {{ $recepcion->funcionario->apellidos }}</td>
				<td class="titulos right">&nbsp;</td>
			</tr>
			<tr>
				<td class="titulos">&nbsp;</td>
				<td class="titulos">{{ $recepcion->funcionario->cargo }}</td>
				
			</tr>
		</table>
		<table id="codigo">
			<tr>
				<td>
					<img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(300)->margin(0)->generate($recepcion->funcionario->nombre.' '.$recepcion->funcionario->apellidos.' | '.$recepcion->funcionario->carnet.''.$recepcion->funcionario->exp.' | '.$recepcion->funcionario->cargo.' | Fecha Solicitud:'.$recepcion->fecha_solicitud)) }} ">
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
					{{-- {{ Carbon\Carbon::now()->format('d/m/Y') }} --}}
					{{ $recepcion->fecha_informe->format('d/m/Y') }}
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
				<h1>INFORME TÉCNICO DE RECEPCION</h1>
			</td>
		</tr>
    </table>
    
	<table id="detalle">
		<tr>
			<td>INFORME TÉCNICO</td>
		</tr>
		<tr>
			<td>{{ "Nro. ". $recepcion->nro_informe  }}</td>
		</tr>
	</table>

	<table id="informacion">
		<tr>
			<td class="titulos" width="10%">Fecha:</td>
			<td width="60%">Sucre, {{ $recepcion->fecha_informe->format('j \\d\\e F \\d\\e\\l Y') }}</td>
			{{-- <td width="60%">Sucre, {{ $recepcion->created_at->format('d/m/Y') }}</td> --}}
			<td class="ticket" width="30%">Número de Ticket</td>
		</tr>
		<tr>
			<td class="titulos">Para:</td>
			<td>Sr(a): {{ $recepcion->ticket->solicitante }}</td>
			<td class="ticket" rowspan="3"><span>{{ $recepcion->ticket->nro_ticket }}/{{ $recepcion->ticket->gestion }}</span></td>
		</tr>
		<tr>
			<td></td>
			<td class="titulos">{{ $recepcion->ticket->unidad->nombre }}</td>
		</tr>
		<tr>
			<td class="titulos">De</td>
			<td>{{ $recepcion->user->tecnico->titulo }} {{ $recepcion->user->tecnico->fullnombre }}</td>
			{{-- <td class="ticket">Fecha de Ingreso</td> --}}
		</tr>
		<tr>
			<td></td>
			<td class="titulos">{{ $recepcion->user->tecnico->cargo }}</td>
			{{-- <td class="ticket">{{ $recepcion->ticket->created_at->format('d/m/Y') }}</td> --}}
		</tr>
		<tr>
			<td class="titulos">Asunto:</td>
			<td colspan="2">{{ $recepcion->asunto }}</td>
		</tr>
	</table>

	<table id="informe">
		<tr>
			<td>De mi mayor consideración:</td>
		</tr>
		<tr>
			<td>En cumplimiento a su solicitud, se informa los siguiente:</td>
		</tr>
	</table>
	<table id="componente">
		<tr>
			<td width="10%" class="titulos">Componente: </td>
			<td>{{ $recepcion->ticket->componente->nombre }}</td>
		</tr>
	</table>

	<table id="recepcion">
		<tr>
			<td width="20%" class="titulos">Orden de Compra: </td>
			<td>{{ $recepcion->orden_compra }}</td>
			<td width="20%" class="titulos">Empresa: </td>
			<td>{{ $recepcion->empresa }}</td>
		</tr>
	</table>
	<hr>
	<div id="caracteristicas-recepcion">
		<h1 class="titulos">Caracteristicas</h1>
		<div class="detalles">
			{!! $recepcion->caracteristicas !!}
		</div>
	</div>
	{{-- <table id="caracteristicas">
		<tr>
			<td class="titulos">Caracteristicas</td>
		</tr>
		<tr>
			<td class="detalles">{!! $recepcion->caracteristicas !!}</td>
		</tr>
	</table> --}}

	<table id="observaciones">
		<tr>
			<td class="titulos">Observaciones</td>
		</tr>
		<tr>
			<td class="detalles">{!! $recepcion->observaciones !!}</td>
		</tr>
	</table>
	<table id="aclaracion">
		<tr>
			<td>En cuanto informo para fines consiguientes.@if($recepcion->fotos()->count() > 0) Se adjunta reporte fotografico orden de compra, factura y garantia(cuando corresponde). @endif</td>
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
			<td class="linea2">{{ $recepcion->user->tecnico->titulo }} {{ $recepcion->user->tecnico->fullnombre }}</td>
			<td></td>
			<td class="titulos right">Nombres</td>
			<td class="linea">&nbsp;</td>
		</tr>
		<tr>
			<td class="titulos">{{ $recepcion->user->tecnico->cargo }}</td>
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

	<table id="codigo" style="margin:75px 0 0 0;">
		<tr>
			<td>
				{{-- <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(300)->margin(0)->mergeString( Storage::get('public/img/box21.png') , 0.3 )->generate($recepcion->autentificacion_recepcion)) }} "> --}}
				<img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(300)->margin(0)->generate($recepcion->autentificacion_recepcion)) }} ">
				<p>Código de Verificación</p>
			</td>
		</tr>
	</table>

	<table width="100%" id="fecha">
		<tr>
			<td colspan="5">Fecha de impresión: {{ $recepcion->fecha_informe->format('d/m/Y h:i:s a') }}</td>
		</tr>
		<tr>
			<td colspan="5">Sistema desarrollado por la <strong>Jefatura de Tecnologías de la Información</strong></td>
		</tr>
	</table>

	@if($recepcion->fotos()->count() > 0)
	<div class="page-break"></div>
	<div class="reporte">
		<h1>REPORTE FOTOGRAFICO</h1>		
	</div>
	<br>
	@foreach($recepcion->fotos as $foto)
		@if($recepcion->fotos->count()==2)
		<div class="fotos2">
			<img src="{{ 'img/fotos/recepcion/'.$foto->carpeta.'/'.$foto->nombre }}">
		 </div>
		 @elseif($recepcion->fotos->count()==3)
		 <div class="fotos3">
			<img src="{{ 'img/fotos/recepcion/'.$foto->carpeta.'/'.$foto->nombre }}">
		 </div>
		 @endif
	 @endforeach
	 <table id="codigo">
		<tr>
			<td>
				<img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(300)->margin(0)->generate($recepcion->autentificacion_recepcion)) }} ">
				<p>Código de Verificación</p>
			</td>
		</tr>
	</table>
	<table width="100%" id="fecha">
		<tr>
			<td colspan="5">Fecha impresión: {{ $recepcion->fecha_informe->format('d/m/Y h:i:s a') }}}</td>
		</tr>
		<tr>
			<td colspan="5">Sistema desarrollado por la <strong>Jefatura de Tecnologías de la Información</strong></td>
		</tr>
	</table>
	 @endif

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