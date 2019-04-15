<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';

    protected $fillable = ['DepartName', 'DepartRegionName', 'DepartCapitalName'];
    
    protected $primaryKey = 'ID_Depart';

    public function Municipios()
    {
        return $this->hasMany('App\Municipio', 'ID_Mun', 'id');//como cliente tiene muchas sedes el busca automaticamente el campo negocios_id
    }
}
