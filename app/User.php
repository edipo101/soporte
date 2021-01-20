<?php

namespace SIS;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, ShinobiTrait;

    protected $fillable = [
        'tecnico_id', 'nickname', 'password',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($valor)
    {
        if(!empty($valor))
            $this->attributes['password'] = \Hash::make($valor);
    }

    public function getNombreTecnicoAttribute(){
        $tecnico = Tecnico::find($this->tecnico_id);
        return $tecnico->fullnombre;
    }

    public function tecnico(){
        return $this->belongsTo(Tecnico::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }

    public function bajas(){
        return $this->hasMany(Baja::class);
    }

    public function reparacions(){
        return $this->hasMany(Reparacion::class);
    }

    public function reposicions(){
        return $this->hasMany(Reposicion::class);
    }

    public function recepcions(){
        return $this->hasMany(Recepcion::class);
    }

    public function externo(){
        return $this->hasMany(Externo::class);
    }
    
    public function direccions(){
        return $this->hasMany(Direccion::class);
    }
}
