<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'email_verified_at', 'password', 'UsType', 'UsAvatar', 'UsStatus', 'UsSlug', 'UsRol', 'UsRolDesc', 'UsRol2', 'UsRolDesc2', 'updated_by', 'FK_UserPers', 'confirmation_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function getRouteKeyName()
    {
        return 'UsSlug';
    }

    //se especifica la raclacion con la tabla personals
    public function usuario(){
        return $this->belongsTo('App\Personal','ID_Pers');
    }
    
    //se especifica la raclacion con la tabla declaraciones
    public function ArticuloProv()
    {
        return $this->hasMany('App\ArticuloPorProveedor', 'ID_ArtiProve', 'id');//como user tiene muchas declaraciones
    }
    public function OrdenCompras()
    {
        return $this->hasMany('App\ordenCompra', 'ID_Orden', 'id');
    }
}
