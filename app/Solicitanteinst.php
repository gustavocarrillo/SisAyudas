<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitanteinst extends Model
{
    protected $table = 'solicitanteinst';

    protected $fillable = ['tipo_reg','codigo_rif','nombre','telefono','direccion','id_municipio','id_parroquia'];

    public function municipio()
    {
        return $this->belongsTo('App\Municipio');
    }

    public function parroquia()
    {
        return $this->belongsTo('App\Parroquia');
    }

    public function solicitudes()
    {
        return $this->belongsToMany('App\Solicitud')->withPivot('detalle','fecha','estatus','fecha_pro')->withTimestamps();
    }

    public function evento()
    {
        return $this->belongsTo('App\Evento');
    }
}
