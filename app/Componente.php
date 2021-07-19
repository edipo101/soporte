<?php

namespace SIS;

use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    protected $fillable = [
        'nombre','icono','visible','descripcion'
    ];

    public function setNombreAttribute($value){
        $this->attributes['nombre'] = strtoupper($value);
    }
    
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }

    
}
