<?php

namespace SIS;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $fillable = [
        'unidad','funcionario','cargo','ipv4','nombrepc','mac','internet','sigma','sigep','redimpresora','observacion','estado','user_id'
    ];

    public function getNombreEstadoAttribute(){
    	return $this->estado == 'N' ? "NORMAL" : "OBSERVADO";
    }

    public function getColorEstadoAttribute(){
    	return $this->estado == 'N' ? "" : "red";
    }

    public function getIconoInternetAttribute(){
    	return $this->internet ? 'fa-check' : 'fa-close';
    }
    public function getIconoSigmaAttribute(){
    	return $this->sigma ? 'fa-check' : 'fa-close';
    }
    public function getIconoSigepAttribute(){
    	return $this->sigep ? 'fa-check' : 'fa-close';
    }

    public function setUnidadAttribute($value){
        $this->attributes['unidad'] = strtoupper($value);
    }

    public function setFuncionarioAttribute($value){
        $this->attributes['funcionario'] = strtoupper($value);
    }

    public function setCargoAttribute($value){
        $this->attributes['cargo'] = strtoupper($value);
    }

    public function setObservacionesAttribute($value){
        $this->attributes['observaciones'] = strtoupper($value);
    }

    public function setMacAttribute($value){
        $this->attributes['mac'] = strtoupper($value);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
