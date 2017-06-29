<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelefonoInst extends Model
{
    protected $table = 'telefonos_inst';

    protected $fillable = ['id','numero'];

    public function solicitante_inst()
    {
        return $this->belongsTo('SolicitanteInst');
    }
}
