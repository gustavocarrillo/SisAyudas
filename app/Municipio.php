<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';

    protected $fillable = ['nombre'];

    public function parroquias()
    {
        return $this->hasMany('Parroquia');
    }

    public function centros()
    {
        return $this->hasMany('Centro');
    }

    public function solicitantes_inst()
    {
        return $this->hasMany('SolicitanteInst');
    }

    public function solicitantes()
    {
        return $this->hasMany('Solicitante');
    }

}
