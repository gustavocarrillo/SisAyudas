<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitantenocne extends Model
{
    protected $table = 'solicitantes_no_cne';

    protected $fillable = ['nacionalidad','cedula','nombres','apellidos','genero','telefonos','direccion','id_municipio','id_parroquia','id_discapacidad','discap_detalle'];

    public function solicitudes()
    {
        return $this->belongsToMany('App\Solicitud')->withPivot('id_evento','detalle','fecha','estatus','fecha_pro')->withTimestamps();
    }

    public function municipio()
    {
        return $this->belongsTo('App\Municipio');
    }

    public function parroquia()
    {
        return $this->belongsTo('App\Parroquia');
    }

    public function discapacidad()
    {
        return $this->belongsTo('App\Discapacidad');
    }

}
