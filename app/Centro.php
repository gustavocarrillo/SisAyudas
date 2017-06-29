<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    protected $table = 'centros';

    protected $fillable = ['nombre','id_parroquia','id_municipio'];

    public function parroquia()
    {
        return $this->belongsTo('Parroquia');
    }

    public function municipio()
    {
        return $this->belongsTo('Municipio');
    }

    public function solicitantes()
    {
        return $this->hasMany('Solicitante');
    }

}
