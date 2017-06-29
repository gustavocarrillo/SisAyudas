<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';

    protected $fillable = ['evento','fecha'];

    public function solicitantesInstSolicitudes()
    {
        return $this->hasMany('SolicitanteInstSolicitud');
    }

    public function solicitanteSolicitud()
    {
        return $this->hasMany('SolicitanteSolicitud');
    }
}
