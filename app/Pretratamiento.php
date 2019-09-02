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

    //lista las requerimientos relacionados usando muchos a muchos aunque no es necesario para la vista
    public function requerimientos()
    {
        return $this->belongsToMany('App\Requerimiento', 'pretratamientos_requerimientos', 'FK_PreTrat', 'FK_Req');
    }

    // public function respels()
    // {
    //     return $this->belongsToMany('App\Respel','pretratamiento_respel', 'FK_PreTrat', 'FK_Respel')
    //     ->withPivot('FK_Trat');
    //     //lista los tratamientos relacionados usando muchos a muchos
    // }

}
