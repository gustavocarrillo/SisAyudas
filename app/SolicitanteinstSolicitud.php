<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitanteinstSolicitud extends Model
{
    protected $table = 'solicitanteinst_solicitud';

    protected $fillable = ['solicitanteinst_id','solicitud_id','detalle','fecha','id_evento','estatus','fecha_pro'];
}
