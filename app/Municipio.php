<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';
    protected $fillable = ['nombre'];

    public function parroquias(){
        return $this->hasMany('App\Parroquia');
    }
    public function centros(){
        return $this->hasMany('App\Centro');
    }
    public function solicitantes(){
        return $this->hasMany('App\Solicitante');
    }
    public function solicitantesNoCne(){
        return $this->hasMany('App\Solicitantenocne');
    }
}
