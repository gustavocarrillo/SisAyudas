<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    protected $table = 'solicitantes';

    protected $fillable = [
        'nacionalidad',
        'cedula',
        'nombres',
        'apellidos',
        'fecha_nac',
        'genero',
        'direccion',
        'edo_civil',
        'id_municipio',
        'id_parroquia',
        'id_centro',
        'id_cargafamiliar',
        'id_usuario'
    ];

    public function municipio()
    {
        return $this->belongsTo('Municipio');
    }

    public function parroquia()
    {
        return $this->belongsTo('Parroquia');
    }

    public function centro()
    {
        return $this->belongsTo('Centro');
    }

    public function grupo_familiar()
    {
        return $this->hasMany('GrupoFamiliar');
    }

    public function usuario()
    {
        return $this->belongsTo('User');
    }

    public function telefonos()
    {
        return $this->hasMany('App\Telefono');
    }

    public function solicitanteSolicitud()
    {
        return $this->hasMany('SolicitanteSolicitud');
    }

    //Se deja en caso de necesitarse el modelo SolicitanteDiscapacidad
    public function solicitanteDiscapacidad()
    {
        return $this->hasMany('SolicitanteDiscapacidad');
    }

    public function discapacidades()
    {
        return $this->belongsToMany('Discapacidad')->withPivot('detalle');
    }

    public function profesiones()
    {
        return $this->belongsToMany('Profesion');
    }

    public function grados_instruccion()
    {
        return $this->belongsToMany('GradoInstruccion');
    }

    public function empresa()
    {
        return $this->belongsTo('Empresa');
    }

    public function solicitante_vivienda()
    {
        return $this->hasOne('SolicitanteVivienda');
    }
}
