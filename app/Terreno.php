<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terreno extends Model
{
    protected $table = 'terrenos';

    protected $fillable = ['estatus'];

    public function solicitantes_viviendas()
    {
        return $this->hasMany('SolicitanteVivienda');
    }
}
