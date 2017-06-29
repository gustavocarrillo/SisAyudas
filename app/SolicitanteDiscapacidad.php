<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitanteDiscapacidad extends Model
{
    protected $table = 'solicitante_discapacidad';

    protected $fillable = ['id_solicitante','id_discapacidad'];

    public function solicitante()
    {
        return $this->belongsTo('Solicitante');
    }

    public function discapacidad()
    {
        return $this->belongsTo('Discapacidad');
    }
}
