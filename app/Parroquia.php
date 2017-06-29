<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    protected $table = 'parroquias';

    protected $fillable = ['nombre','id_municipio'];

    public function municipio()
    {
        return $this->belongsTo('Municipio');
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
