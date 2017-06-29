<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitanteInst extends Model
{
    protected $table = 'solicitantes_inst';

    protected $fillable = ['tipo_reg','rif','nombre','direccion','id_municipio','id_parroquia','id_usuario'];

    public function parroquia()
    {
        return $this->belongsTo('Parroquia');
    }

    public function municipio()
    {
        return $this->belongsTo('Municipio');
    }

    public function usuario()
    {
        return $this->belongsTo('User');
    }

    public function telefonos_inst()
    {
        return $this->hasMany('TelefonoInst');
    }

    public function responsable_inst()
    {
        return $this->hasMany('ResponsableInst');
    }

    public function solicitantesInstSolicitudes()
    {
        return $this->hasMany('SolicitanteInstSolicitud');
    }
}
