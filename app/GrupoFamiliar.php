<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoFamiliar extends Model
{
    protected $table = 'grupos_familiares';

    protected $fillable = ['id_solicitante','cedula','nacionalidad','fecha_nac','genero','parentesco','discapacitado'];

    public function solicitante()
    {
        return $this->belongsTo('Solicitante');
    }

    public function profesiones()
    {
        return $this->belongsToMany('Profesion');
    }
}
