<?php

namespace SIS;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    protected $fillable = [
        'carnet', 'nombre', 'apellidos', 'foto', 'cargo', 'titulo'
    ];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }

    public function setApellidosAttribute($value)
    {
        $this->attributes['apellidos'] = strtoupper($value);
    }

    public function setCargoAttribute($value)
    {
        $this->attributes['cargo'] = strtoupper($value);
    }

    public function getFullNombreAttribute(){
    	return "$this->nombre $this->apellidos";
    }
}
