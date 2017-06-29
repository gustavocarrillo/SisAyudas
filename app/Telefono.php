<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $table = 'telefonos';

    protected $fillable = ['solicitante_id','numero','comentario'];

    public function solicitante()
    {
        return $this->belongsTo('App\Solicitante');
    }
}
