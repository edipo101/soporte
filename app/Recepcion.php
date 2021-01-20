<?php

namespace SIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SIS\Informe;
use Jenssegers\Date\Date;

class Recepcion extends Model
{
    use Informe, SoftDeletes;

    protected $fillable = [
        'nro_informe','ticket_id', 'user_id', 'asunto', 'gestion', 'orden_compra', 'empresa', 'caracteristicas', 'observaciones','fecha_informe','observacion_fecha','funcionario_id','userfecha','fecha_solicitud'
    ];
    
    protected $dates = [
        'deleted_at',
        'fecha_informe',
        'fecha_solicitud',
    ];

    protected $morphClass = 'recepcion';

    public function fotos()
    {
        return $this->morphMany(Foto::class, 'fotoable');
    }

    public function getFechaInformeAttribute($date){
        if($date == "")
            return null;
        else
            return new Date($date);
    }

    public function getAutentificacionRecepcionAttribute(){
        $user = $this->user;
        $tecnico = $user->tecnico;
        $nombre = $tecnico->fullnombre;
        return "$this->nro_informe | $this->orden_compra | $this->empresa | $nombre";
    }

    public function setEmpresaAttribute($value){
        $this->attributes['empresa'] = strtoupper($value);
    }

    // public function setObservacionesAttribute($value){
    //     $this->attributes['observaciones'] = strtoupper($value);
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

    /**
     * Relacion 1 a muchos con modelo Funcionario
     */
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

}
