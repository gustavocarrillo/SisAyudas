<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discapacidad extends Model
{
    protected $table = 'discapacidades';

    protected $fillable = ['discapacidad'];

    public function solicitantes()
    {
        return $this->hasMany('App\Solicitante');
    }

    public function solicitantesnocne()
    {
        return $this->hasMany('App\Solicitantenocne');
    }

    public $timestamps = false;
}
