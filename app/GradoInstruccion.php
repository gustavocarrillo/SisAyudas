<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradoInstruccion extends Model
{
    protected $table = 'grados_instruccion';

    protected $fillable = ['grado'];

    public function solicitantes()
    {
        return $this->belongsToMany('Solicitante');
    }
}
