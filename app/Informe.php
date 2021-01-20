<?php

namespace SIS;
// use Illuminate\Database\Eloquent\SoftDeletes;

trait Informe
{
    // use SoftDeletes;
    
    // protected $dates = [
    //     'deleted_at',
    //     'fecha_informe',
    // ];
    
    public function setAsuntoAttribute($value){
        $this->attributes['asunto'] = strtoupper($value);
    }

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeReporte($query, $fecha1, $fecha2,$usuario){
        return $query->where('fecha_informe','>=',$fecha1)
                    ->where('fecha_informe','<=',$fecha2)
                    ->where('user_id',$usuario);
    }
    public function scopeReporteMes($query, $mes, $year,$usuario){
        return $query->whereMonth('fecha_informe', $mes)
                    ->whereYear('fecha_informe', $year)
                    ->where('user_id',$usuario);
    }

    public function getAutentificacionAttribute(){
        $user = $this->user;
        $tecnico = $user->tecnico;
        $nombre = $tecnico->fullnombre;
        return "$this->nro_informe | $this->asunto |  $nombre";
    }
}