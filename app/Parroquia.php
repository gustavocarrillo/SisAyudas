<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    protected $table = 'parroquias';
    protected $fillable = ['nombre','id_municipio'];

    public function municipio()
    {
        return $this->belongsTo('App\Municipio');
    }

    public function centros()
    {
        return $this->hasMany('App\Centro');
    }

    public function solicitantes()
    {
        return $this->hasMany('App\Solicitante');
    }

    public function solicitantesNoCne()
    {
        return $this->hasMany('App\Solicitantenocne');
    }
}
