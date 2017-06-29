<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';

    protected $fillable = ['solicitud','intervalo'];

    public function solicitantesIstSolicitudes()
    {
        return $this->hasMany('SolicitanteInstSolicitud');
    }

    public function solicitanteSolicitud()
    {
        return $this->hasMany('SolicitanteSolicitud');
    }

    public function getSolicitudes()
    {
        $solicitudes = Solicitud::all();

        return $solicitudes;
    }
}
