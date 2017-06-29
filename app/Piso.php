<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piso extends Model
{
    protected $table = 'pisos';

    protected $fillable = ['tipo'];

    public function solicitantes_viviendas()
    {
        return $this->hasMany('SolicitanteVivienda');
    }
}
