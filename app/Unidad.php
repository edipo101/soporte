<?php

namespace SIS;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }

    public function externo(){
        return $this->hasMany(Externo::class);
    }
}
