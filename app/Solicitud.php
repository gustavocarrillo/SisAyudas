<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';
    protected $fillable = ['nombre','intervalo'];

    public function solicitantes(){
        return $this->belongsToMany('App\Solicitante')->withPivot('detalle','fecha','estatus','fecha_pro')->withTimestamps();
    }
    public function solicitantesNoCne(){
        return $this->belongsToMany('App\Solicitantenocne')->withPivot('detalle','fecha','estatus','fecha_pro')->withTimestamps();
    }
    public function solicitantesInstitucion(){
        return $this->belongsToMany('App\Solicitanteinst')->withPivot('detalle','fecha','estatus','fecha_pro')->withTimestamps();
    }
}
