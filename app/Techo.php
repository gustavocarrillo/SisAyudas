<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Techo extends Model
{
    protected $table = 'techos';

    protected $fillable = ['tipo'];

    public function solicitantes_viviendas()
    {
        return $this->hasMany('SolicitanteVivienda');
    }
}
