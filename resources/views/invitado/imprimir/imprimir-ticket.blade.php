<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Ticket | {{ $ticket->id }}  </title>
<link rel="stylesheet" href="css/ticket.css">
</head>
<body>
	<script type="text/php">
		if (isset($pdf)) {
			$x = $pdf->get_width()-200;
			$y = $pdf->get_height()-40;
			$text = "Fecha de impresión {{Carbon\Carbon::now()->format('d/m/Y g:i:s a')}}";
			$font = null;
			$size = 8;
			$color = array(0,0,0);
			$word_space = 0.0;  //  default
			$char_space = 0.0;  //  default
			$angle = 0.0;   //  default
			$pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);

			//otro texto
			$pdf->page_text(30, $y, 'Sistema de Soporte Técnico', $font, $size, $color, $word_space, $char_space, $angle);
			$pdf->page_text(30, $y+10, 'Desarrollado por la Jefatura de Tecnologias de la Información', $font, $size, $color, $word_space, $char_space, $angle);
			//$pdf->line(20,$y,$pdf->get_width()-110,$y,array(0,0,0),1);
		}
	</script>

	<div>
		<table id="header">
			<tr>
				<td width="15%" rowspan="3" class="center">
					<img src="img/logo.png" width='200px'>
				</td>
				<td width="65%" class="center">
					<h1>GOBIERNO AUTÓNOMO MUNICIPAL DE SUCRE</h1>
				</td>
				<td width="20%" rowspan="3" class="center">
					<img src="img/logoGestion.png" width='300px'>
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

		<table id="table_parent">
			<tr>
				<td colspan="4" class="box_complete box_title">
					1. INFORMACION DE SOLICITANTE
				</td>
			</tr>
			<tr>
				<td width="70%" class="box_borderB">
					@if(!$ticket->solicitante=='')
					<div class="text_mini">NOMBRE SOLICITANTE</div>
					<div class="text_reg">{{ $ticket->solicitante }}</div>
					@elseif(!$ticket->empresa=='')
					<div class="text_mini">EMPRESA SOLICITANTE</div>
					<div class="text_reg">{{ $ticket->empresa }}</div>
					@endif					
				</td>
				<td width="30%" colspan="3" class="box_borderLB">
					<div class="text_mini">CELULAR DE REFERENCIA</div>
					<div class="text_reg">{{ $ticket->celular_referencia ? : "S/N" }}</div>
				</td>
			</tr>
			<tr>
				<td width="70%">
					<div class="text_mini" style="top:0;  position:absolute;">UNIDAD SOLICITANTE</div>
					<div class="text_reg">{{ $ticket->unidad->nombre }}</div>
				</td>
				<td width="30%" colspan="3" class="box_borderLB">
					<div class="text_mini">TELEFONO UNIDAD</div>
					<div class="text_reg">{{ $ticket->telef_referencia ? : "S/N"}}</div>					
				</td>
			</tr>
			
		</table>


		<table id="table_parent">
			<tr>
				<td colspan="4" class="box_complete box_title">
					2. INFORMACION GENERAL DE SOPORTE
				</td>
			</tr>
			<tr>
				<td width="50%" colspan="2" class="box_borderB">
					<div class="text_mini">COMPONENTE</div>
					<div class="text_reg">{{ $ticket->componente->nombre }}</div>
				</td>
				<td width="25%" class="box_borderLB">
					<div class="text_mini">FECHA DE RECEPCION</div>
					<div class="text_reg">{{ $ticket->created_at->format('d/m/Y') }}</div>
				</td>
				<td width="25%" class="box_borderLB">
					<div class="text_mini">HORA DE RECEPCION</div>
					<div class="text_reg">{{ $ticket->created_at->format('H:i:s') }}</div>
				</td>
			</tr>
			<tr>
				<td width="100%" colspan="4" class="box_borderB" >
					<div class="text_mini">OBSERVACION</div>
					<div class="text_reg" style="text-align: left; margin-left:10px">{{ $ticket->observacion ? : "SIN OBSERVACIONES" }}</div>
				</td>
			</tr>
			<tr>
				<td width="100%" colspan="4" >
					<div class="text_mini">DIAGNOSTICO</div>
					<div class="text_reg" style="text-align: left; margin-left:10px">
						@foreach($ticket->diagnosticos as $diagnostico)
							<p style="margin: 10px 0"><strong>{{ $diagnostico->nombre }}</strong> ({{ $diagnostico->descripcion }})</p>
						@endforeach	
					</div>
				</td>
			</tr>
		</table>

		@if(!$ticket->empresa=='')
		<table id="table_parent">
			<tr>
				<td colspan="4" class="box_complete box_title">
					3. DOCUMENTACION ENTREGADA
				</td>
			</tr>			
			<tr>
				<td width="100%" colspan="4" class="box_borderB" >
					<div class="text_mini">SE ENTREGO LOS SIGUIENTES DOCUMENTOS:</div>
					<div class="text_reg" style="text-align: left; margin-left:10px">						
						<div>
							<label><img src="img/{{ $ticket->factura }}.png" width='42px'> FACTURA</label>
						</div>
						<div>
							<label><img src="img/{{ $ticket->ordencompra }}.png" width='42px'> ORDEN DE COMPRA</label>
						</div>
						<div>
							<label><img src="img/{{ $ticket->garantia }}.png" width='42px'> GARANTIA</label>
						</div>
					</div>
				</td>
			</tr>			
		</table>
		@endif

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
		
		<div style="height: 480px;">
			<div style="float: left; width: 70%; font-size:0.6em; margin-top:50px;">
				<div style="text-align:center;">NOTA</div>
				<div style="text-align:left;">
					<p>1. El equipo o dispositivo se entregara aproximadamente 48 horas despues de su designacion del ticket al respectivo Ténico de soporte, pasado el plazo se recomienda llamar a la unidad de Soporte Técnico.</p>
					<p>2. Se aclara que los días pueden variar dependiendo de la dificultad del equipo o dispositivo</p>
				</div>
				<div style="text-align:center;">ACLARACION</div>
				<div>
					<p>1. La Jefatura de Tecnologías de la Información no se hace responsable del equipo o dispositivo dejado una vez pasado los días aproximados para su revisión</p>
				</div>
			</div>
			<div class="box_qr">
				<img lass="box_imgqr" src="data:image/png;base64, {!! base64_encode( QrCode::format('png')->color(0,0,0)->size(302)->margin(1)->mergeString( Storage::get('public/img/box21.png') , 0.26 )->generate( 'Ticket: '. $ticket->nro_ticket .PHP_EOL.' Fecha de recepción: ' . $ticket->created_at->format('d/m/Y H:i:s')) ) !!} ">
				<div style="color: #fff; margin-top:0;">TICKET</div>
				<div class="box_qrnum">{{ $ticket->nro_ticket }}</div>
			</div>
		</div>
		
	</div>	
		
</body>
</html>