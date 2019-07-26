<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pretratamiento extends Model
{
    
	protected $table = 'pretratamientos';

	protected $primaryKey = 'ID_PreTrat';

	protected $fillable=['PreTratName', 'PreTratDescription'];


    public function tratamientos()
    {
        return $this->belongsToMany('App\Tratamiento','pretratamiento_tratamiento', 'FK_PreTrat', 'FK_Trat');
        //lista los tratamientos relacionados usando muchos a muchos
    }

}
