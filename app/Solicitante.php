<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    protected $table = 'solicitantes';

    protected $fillable = ['nacionalidad','cedula','nombres','apellidos','genero','telefono','id_municipio','id_parroquia','id_centro','id_discapacidad','discap_detalle'];

    public function solicitudes()
    {
        return $this->belongsToMany('App\Solicitud')->withPivot('id','id_evento','detalle','fecha','estatus')->withTimestamps();
    }

    public function municipio()
    {
        return $this->belongsTo('App\Municipio');
    }

    public function parroquia()
    {
        return $this->belongsTo('App\Parroquia');
    }

    public function centro()
    {
        return $this->belongsTo('App\Centro');
    }

    public function discapacidad()
    {
        return $this->belongsTo('App\Discapacidad');
    }

}
