<?php

namespace SIS;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $fillable = [
        'carnet', 'exp', 'apellidos', 'nombre','cargo'
    ];

    /**
	 * Convertir el atributo carnet a mayusculas cuando se guarda o se edita.
	 *
	 * @var value
	 */
    public function setCarnetAttribute($value)
    {
        $this->attributes['carnet'] = mb_strtoupper($value);
    }

    /**
	 * Convertir el atributo nombre a mayusculas cuando se guarda o se edita.
	 *
	 * @var value
	 */
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = mb_strtoupper($value);
    }

    /**
	 * Convertir el atributo apellidos a mayusculas cuando se guarda o se edita.
	 *
	 * @var value
	 */
    public function setApellidosAttribute($value)
    {
        $this->attributes['apellidos'] = mb_strtoupper($value);
    }

    /**
	 * Convertir el atributo cargo a mayusculas cuando se guarda o se edita.
	 *
	 * @var value
	 */
    public function setCargoAttribute($value)
    {
        $this->attributes['cargo'] = mb_strtoupper($value);
    }
}
