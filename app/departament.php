<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class departament extends Model
{
    protected $table = 'Departamento';

    protected $fillable = ['DepartName', 'DepartRegionName', 'DepartCapitalName'];
    
    protected $primaryKey = 'ID_Depart';

    public function Municipio()
    {
        return $this->hasMany('App\Municipio', 'ID_Mun', 'id');//como cliente tiene muchas sedes el busca automaticamente el campo negocios_id
    }
}
