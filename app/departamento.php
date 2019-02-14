<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class departamento extends Model
{
    protected $table = 'Departamentos';

    protected $fillable = ['DepartName', 'DepartRegionName', 'DepartCapitalName'];
    
    protected $primaryKey = 'ID_Depart';

    public function Municipio()
    {
        return $this->hasMany('App\Municipios', 'ID_Mun', 'id');//como cliente tiene muchas sedes el busca automaticamente el campo negocios_id
    }
}
