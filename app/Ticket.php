<?php

namespace SIS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
     use SoftDeletes;

     protected $fillable = [
        'nro_ticket', 'gestion', 'unidad_id', 'user_id', 'solicitante', 'telef_referencia', 'celular_referencia', 'componente_id', 'observacion', 'prioridad', 'estado','empresa','factura','ordencompra','garantia'
    ];

    protected $dates = [
        'deleted_at',
        'fecha_entrega',
        'fecha_asignada',
    ];

    public function setSolicitanteAttribute($value){
        $this->attributes['solicitante'] = strtoupper($value);
    }
    public function setEmpresaAttribute($value){
        $this->attributes['empresa'] = strtoupper($value);
    }

    public function setObservacionAttribute($value){
        $this->attributes['observacion'] = strtoupper($value);
    }

    public function getNombreEstadoAttribute(){
    	if ($this->estado == 'R')
    		return "RECEPCIONADO";
    	elseif ($this->estado == 'A')
    		return "ASIGNADO";
    	else
    		return "FINALIZADO";
    }

    public function getColorEstadoAttribute(){
        if ($this->estado == 'R')
            return "bg-teal";
        elseif ($this->estado == 'A')
            return "bg-primary";
        else
            return "bg-green";
    }

    public function getFullTicketAttribute(){
        return "$this->nro_ticket/$this->gestion";
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function unidad(){
        return $this->belongsTo(Unidad::class);
    }

    public function componente(){
        return $this->belongsTo(Componente::class);
    }

    public function diagnosticos(){
        return $this->belongsToMany(Diagnostico::class);
    }
}
