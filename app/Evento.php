<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';

    protected $fillable = ['nombre','fecha'];

    public function solicitantes()
    {
        return $this->hasMany('App\Solicitante');
    }

    public function solicitantesInst()
    {
        return $this->hasMany('App\Solicitanteinst');
    }

    public function solicitantesNoCne()
    {
        return $this->hasMany('App\Solicitantenocne');
    }

    public $timestamps = false;
}
