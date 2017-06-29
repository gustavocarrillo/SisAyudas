<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViviendaEstatus extends Model
{
    protected $table = 'viviendas_estatus';

    protected $fillable = ['estatus'];

    public function solicitantes_viviendas()
    {
        return $this->hasMany('SolicitanteVivienda');
    }
}
