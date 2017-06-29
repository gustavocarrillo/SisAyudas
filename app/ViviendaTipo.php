<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViviendaTipo extends Model
{
    protected $table = 'viviendas_tipos';

    protected $fillable = ['tipo'];

    public function solicitantes_viviendas()
    {
        return $this->hasMany('SolicitanteVivienda');
    }
}
