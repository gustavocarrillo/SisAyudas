<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaveDesbloqueo extends Model
{
    protected $table = 'claves_desbloqueo';

    protected $fillable = ['clave'];
}
