<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponsableInst extends Model
{
    protected $table = 'responsables_inst';

    protected $fillable =['id_solicitante_inst','nacionalidad','cedula','nombres_apellidos','telefono'];

    public function solicitante_inst()
    {
        return $this->belongsTo('SolicitanteInst');
    }
}
