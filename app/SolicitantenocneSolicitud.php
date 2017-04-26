<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitantenocneSolicitud extends Model
{
    protected $table = 'solicitantenocne_solicitud';

    protected $fillable = ['solicitantenocne_id','solicitud_id','detalle','fecha','id_evento','estatus','fecha_pro'];
}
