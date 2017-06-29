<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    protected $table = 'profesiones';

    protected $fillable = ['nombre'];

    public function solicitantes()
    {
        return $this->belongsToMany('Solicitante');
    }

    public function gruposFamiliares()
    {
        return $this->belongsToMany('GrupoFamiliar');
    }

}
