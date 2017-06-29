<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios';

    protected $fillable = ['nombre'];

    public function solicitantes_viviendas()
    {
        return $this->belongsToMany('SolicitanteVivienda');
    }
}
