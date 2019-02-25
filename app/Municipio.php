<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'Municipios';

    protected $fillable = ['MunName', 'FK_MunCity'];
    
    protected $primaryKey = 'ID_Mun';
}
