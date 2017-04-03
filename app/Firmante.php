<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firmante extends Model
{
    protected $table = 'firmantes';
    protected $fillable = ['cedula','nombres_apellidos'];
}
