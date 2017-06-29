<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pared extends Model
{
    protected $table = 'paredes';

    protected $fillable = ['tipo'];

    public function solicitantes_viviendas()
    {
        return $this->hasMany('SolicitanteVivienda');
    }
}
