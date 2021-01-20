<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Informe Tecnico Externo | {{ $externo->user->nickname }}  </title>
<link rel="stylesheet" href="css/externos.css">
</head>
<body>
    <h1 class="h1">SOPORTE TECNICO EXTERNO</h1>
    <table id="descripcion">
        <tr>
            <td colspan="4">
                <h1>
                    JEFATURA DE TECNOLOGIAS DE LA INFORMACION
                </h1>
            </td>
        </tr>
        <tr>
            <td width="20%" class="titulo">Fecha:</td>
            <td width="35%" class="detalle">{{ $externo->fecha_elaboracion->format('d/m/Y') }}</td>
            <td width="25%" class="titulo">Técnico:</td>
            <td width="40%" class="detalle">{{ $externo->user->tecnico->fullnombre }}</td>
        </tr>
        <tr>
            <td class="titulo">Funcionario:</td>
            <td class="detalle" colspan="3">{{ $externo->nombre }}</td>
        </tr>
        <tr>
            <td class="titulo">Oficina:</td>
            <td class="detalle" colspan="3">{{ $externo->unidad->nombre }}</td>
        </tr>
    </table>
    
    <table id="servicios">
        <tr>
            <td colspan="14">
                <h1>SERVICIO Y/O PROBLEMA EN EL EQUIPO</h1>
            </td>
        </tr>
        <tr>
            @foreach($servicios as $servicio )
            <td class="{{ $externo->servicios->contains('nombre',$servicio->nombre) ? "check": "" }}"></td>
            <td>{{ $servicio->nombre }}</td>
            @endforeach
        </tr>
    </table>
    <table id="otros">
        <tr>
            <td class="titulo">Descripción del Problema</td>
        </tr>
        <tr>
            <td class="detalle">{{ $externo->descripcion }}</td>
        </tr>
    </table>
    <table id="firma">
        <tr>
            <td>Firma de Conformidad</td>
        </tr>
    </table>
    <br><br><br><br><br><br><br><br>
    <h1 class="h1">SOPORTE TECNICO EXTERNO</h1>
    <table id="descripcion">
        <tr>
            <td colspan="4">
                <h1>
                    JEFATURA DE TECNOLOGIAS DE LA INFORMACION
                </h1>
            </td>
        </tr>
        <tr>
            <td width="20%" class="titulo">Fecha:</td>
            <td width="35%" class="detalle">{{ $externo->fecha_elaboracion->format('d/m/Y') }}</td>
            <td width="25%" class="titulo">Técnico:</td>
            <td width="40%" class="detalle">{{ $externo->user->tecnico->fullnombre }}</td>
        </tr>
        <tr>
            <td class="titulo">Funcionario:</td>
            <td class="detalle" colspan="3">{{ $externo->nombre }}</td>
        </tr>
        <tr>
            <td class="titulo">Oficina:</td>
            <td class="detalle" colspan="3">{{ $externo->unidad->nombre }}</td>
        </tr>
    </table>
    
    <table id="servicios">
        <tr>
            <td colspan="14">
                <h1>SERVICIO Y/O PROBLEMA EN EL EQUIPO</h1>
            </td>
        </tr>
        <tr>
            @foreach($servicios as $servicio )
            <td class="{{ $externo->servicios->contains('nombre',$servicio->nombre) ? "check": "" }}"></td>
            <td>{{ $servicio->nombre }}</td>
            @endforeach
        </tr>
    </table>
    <table id="otros">
        <tr>
            <td class="titulo">Descripción del Problema</td>
        </tr>
        <tr>
            <td class="detalle">{{ $externo->descripcion }}</td>
        </tr>
    </table>
    <table id="firma">
        <tr>
            <td>Firma de Conformidad</td>
        </tr>
    </table>
</body>
</html>