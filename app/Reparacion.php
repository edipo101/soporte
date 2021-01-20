<?php

namespace SIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SIS\Informe;
use Jenssegers\Date\Date;

class Reparacion extends Model
{
    use Informe, SoftDeletes;

    protected $fillable = [
        'nro_informe','ticket_id', 'user_id', 'asunto', 'gestion', 'caracteristicas', 'diagnostico', 'trabajo_realizado', 'recomendaciones','fecha_informe','observacion_fecha','funcionario_id','userfecha','fecha_solicitud'
    ];

    protected $dates = [
        'deleted_at',
        'fecha_informe',
        'fecha_solicitud',
    ];

    public function getFechaInformeAttribute($date){
        if($date == "")
            return null;
        else
            return new Date($date);
    }
    
    // public function setDiagnosticoAttribute($value){
    //     $this->attributes['diagnostico'] = strtoupper($value);
    // }

    // public function setRecomendacionesAttribute($value){
    //     $this->attributes['recomendaciones'] = strtoupper($value);
    // }  
    
    /**
	 * Convertir el atributo observacion_fecha a mayusculas cuando se guarda o se edita.
	 *
	 * @var value
	 */
    public function setObservacionFechaAttribute($value)
    {
        $this->attributes['observacion_fecha'] = mb_strtoupper($value);
    }
    
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}
