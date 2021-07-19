<?php

namespace SIS;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;
use SIS\Informe;

/**
 * Importante: campo "gestion" ya no se utiliza
*/
class Externo extends Model
{

    use Informe;

    protected $fillable = [
        'nombre','unidad_id','user_id','descripcion','fecha_elaboracion','fecha_entrega','estado'
    ];

    protected $dates = [
        'fecha_elaboracion',
        'fecha_entrega',
    ];

    public function getFechaElaboracionAttribute($date){
        if($date == "")
            return null;
        else
            return new Date($date);
    }

    public function getFechaEntregaAttribute($date){
        if($date == "")
            return null;
        else
            return new Date($date);
    }

    public function setNombreAttribute($value){
        $this->attributes['nombre'] = strtoupper($value);
    }
    public function setDescripcionAttribute($value){
        $this->attributes['descripcion'] = strtoupper($value);
    }

    public function getFullEstadoAttribute(){
    	switch ($this->estado) {
    		case 'E':
    			return 'ELABORADO';
    			break;
    		case 'R':
    			return 'RECEPCIONADO';
    			break;
    		
    		default:
    			return 'FINALIZADO';
    			break;
    	}
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function unidad(){
        return $this->belongsTo(Unidad::class);
    }

    public function servicios(){
    	return $this->belongsToMany(Servicio::class);
    }

}
