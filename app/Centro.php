<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    protected $table = 'centros';
    protected $fillable = ['nombre','id_municipio','id_parroquia'];

    public function solicitantes(){
        return $this->hasMany('App\Solicitantes');
    }
    public function municipio(){
        return $this->belongsTo('App\Municipio');
    }
    public function parroquia(){
        return $this->belongsTo('App\Parroquia');
    }

}
