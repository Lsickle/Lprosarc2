<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'Municipios';

    protected $fillable = ['MunName', 'FK_MunCity'];
    
    protected $primaryKey = 'ID_Mun';

    // public function Municipios()
    // {
    //     return $this->hasMany('App\Municipio', 'ID_Mun', 'id');//como cliente tiene muchas sedes el busca automaticamente el campo negocios_id
    // }
}
