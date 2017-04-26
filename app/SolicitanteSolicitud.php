<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitanteSolicitud extends Model
{
    protected $table = 'solicitante_solicitud';

    protected $fillable = ['solicitante_id','solicitud_id','detalle','fecha','id_evento','estatus','fecha_pro'];
}
