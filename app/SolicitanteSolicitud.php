<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitanteSolicitud extends Model
{
    protected $table = 'solicitante_solicitud';

    protected $fillable = ['id_solicitante','id_solicitud','id_evento','fecha','detalle','estatus','fecha_pro','id_usuario'];

    public function solicitante()
    {
        return $this->belongsTo('Solicitante');
    }

    public function solicitud()
    {
        return $this->belongsTo('Solicitud');
    }

    public function evento()
    {
        return $this->belongsTo('Evento');
    }

    public function usuario()
    {
        return $this->belongsTo('User');
    }
}
