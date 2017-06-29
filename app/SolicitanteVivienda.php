<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitanteVivienda extends Model
{
    protected $table = 'solicitante_vivienda';

    protected $fillable = [
        'solicitante_id',
        'id_terreno_estatus',
        'id_vivienda_estatus',
        'id_vivienda_tipo',
        'id_pared',
        'id_piso',
        'id_techo',
        'tiempo_sector'
    ];

    public function solicitantes()
    {
        return $this->belongsToMany('Solicitante');
    }

    public function terreno_estatus()
    {
        return $this->belongsTo('Terreno');
    }

    public function vivienda_estatus()
    {
        return $this->belongsTo('ViviendaEstatus');
    }

    public function vivienda_tipo()
    {
        return $this->belongsTo('ViviendaTipo');
    }

    public function pared()
    {
        return $this->belongsTo('Pared');
    }

    public function piso()
    {
        return $this->belongsTo('Piso');
    }

    public function techo()
    {
        return $this->belongsTo('Techo');
    }

    public function servicios()
    {
        return $this->belongsToMany('Servicio');
    }

}
