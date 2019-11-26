<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
	protected $table='rols';
    

    protected $fillable = [
        'RolName', 'RolDesc', 'RolDelete'
    ];

}
