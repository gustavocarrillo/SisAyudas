<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discapacidad extends Model
{
    protected $table = 'discapacidades';

    protected $fillable = ['discapacidad'];

    //Se deja en caso de necesitarse el modelo SolicitanteDiscapacidad
    public function solicitanteDiscapacidad()
    {
        return $this->hasMany('SolicitanteDiscapacidad');
    }

    public function solicitantes()
    {
        return $this->belongsToMany('Solicitante')->withPivot('detalle');
    }
}
