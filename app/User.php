<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','nacionalidad','cedula','username','password','tipo','foto','estatus'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function solicitantes_inst()
    {
        return $this->hasMany('SolicitanteInst');
    }

    public function solicitantesInstSolicitudes()
    {
        return $this->hasMany('SolicitanteInstSolicitud');
    }

    public function solicitantes()
    {
        return $this->hasMany('Solicitante');
    }

    public function solicitanteSolicitud()
    {
        return $this->hasMany('SolicitanteSolicitud');
    }
}
