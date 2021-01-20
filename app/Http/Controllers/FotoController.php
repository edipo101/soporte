<?php

namespace SIS\Http\Controllers;

use SIS\Foto;
use SIS\Recepcion;
use SIS\Reposicion;
use Illuminate\Http\Request;
use Storage;

class FotoController extends Controller
{
    public function show(Foto $foto)
    {
        return $foto;
    }

    public function apiFotos($id, $tipo)
    {
        switch ($tipo) {
            case 'Recepcion':
                $registro = Recepcion::find($id);
                break;
            
            case 'Reposicion':
                $registro = Reposicion::find($id);
                break;
        }
        
        $fotos = $registro->fotos;
        
        $listaFotos = '';
        foreach ($fotos as $foto) {
            $listaFotos .='
            <li> 
                <span class="mailbox-attachment-icon has-img">
                    <img src="'. asset('img/fotos/'.strtolower($tipo).'/'.$foto->carpeta.'/'.$foto->nombre).'">
                </span>

                <div class="mailbox-attachment-info">
                    <a href="javascript:void(0);" onclick="mostrar('. $foto->id .',"'.strtolower($tipo).'");return false;" class="mailbox-attachment-name"><i class="fa fa-camera"></i> '.$foto->nombre.'</a>
                    <span class="mailbox-attachment-size">
                        '.$foto->tamanio.'
                        <a href="javascript:void(0);" onclick="eliminarfoto('.$foto->id .');return false;" class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash"></i></a>
                    </span>
                </div>
            </li>
            ';
        }
        return $listaFotos;
    }

    public function destroy(Foto $foto)
    {
        
        $id = $foto->fotoable->id;
        $tipo = explode('\\',$foto->fotoable_type);
        // //Eliminar la fotografia del sistema
        Storage::disk('public')->delete('fotos/'.strtolower($tipo[1]).'/'.$foto->carpeta.'/'.$foto->nombre);
        //Eliminar la fotografia de la base de datos
        $foto->delete();
        //Devolver mensaje de confirmacion

        return response()->json([
            'mensaje' => 'La fotografia fue eliminado correctamente',
            'id' => $id,
            'tipo' => $tipo[1],
        ]);
    }
}
