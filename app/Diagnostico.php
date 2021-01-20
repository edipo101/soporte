<?php

namespace SIS;

use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'estado'
    ];

    public function getNombreEstadoAttribute(){
    	return $this->estado == 'A' ? "HABILITADO" : "DESHABILITADO";
    }

    public function setNombreAttribute($value){
        $this->attributes['nombre'] = strtoupper($value);
    }

    public function setDescripcionAttribute($value){
        $this->attributes['descripcion'] = strtoupper($value);
    }

    public function tickets(){
    	return $this->belongsToMany(Ticket::class);
    }
}
