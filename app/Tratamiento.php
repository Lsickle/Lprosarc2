<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{

	protected $table = 'tratamientos';

	protected $primaryKey = 'ID_Trat';

	protected $fillable=['TratName', 'TratTipo', 'TratDelete', 'TratPretratamiento', 'FK_TratRespel',' FK_TratProv'];

    public function gestor()
	{
	 return $this->belongsTo('App\Cliente', 'FK_TratProv', 'ID_Sede');
	 //como tratamiento pertenece a un gestor/sede de cliente
	}

    public function clasificaciones()
    {
        return $this->belongsToMany('App\Clasificacion','clasificacion_tratamiento', 'FK_Trat', 'FK_Clasf');
        //lista las clasificaciones relacionados usando muchos a muchos
    }
    public function pretratamientos()
    {
        return $this->belongsToMany('App\Pretratamiento','pretratamiento_tratamiento', 'FK_Trat', 'FK_PreTrat');
        //lista las pretratamientos relacionados usando muchos a muchos
    }
    public function respels()
    {
        return $this->belongsToMany('App\Respel','respel_tratamiento', 'FK_Trat', 'FK_Respel');
        //lista las pretratamientos relacionados usando muchos a muchos
    }

}
