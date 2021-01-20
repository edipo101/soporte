<?php

namespace SIS;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = [
        'nombre','carpeta','tamanio','tipo',
    ];

    public function fotoable()
    {
        return $this->morphTo();
    }
}
