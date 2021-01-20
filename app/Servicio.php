<?php

namespace SIS;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
        'nombre','descripcion'
    ];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }

    public function setDescripcionAttribute($value)
    {
        $this->attributes['Descripcion'] = strtoupper($value);
    }

    public function externos(){
    	return $this->belongsToMany(Externo::class);
    }
}
