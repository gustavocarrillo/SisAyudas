<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitanteInstSolicitud extends Model
{
    protected $table = 'solicitanteinst_solicitud';

    protected $fillable = ['id_evento','id_solicitanteinst','id_solicitud','fecha','detalle','estatus','fecha_pro','id_usuario'];

    public function evento()
    {
        return $this->belongsTo('Evento');
    }

    public function solicitante_inst()
    {
        return $this->belongsTo('SolicitanteInst');
    }

    public function solicitud()
    {
        return $this->belongsTo('Solicitud');
    }

    public function usuario()
    {
        return $this->belongsTo('User');
    }
}
