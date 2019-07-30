<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    protected $table = 'clasificacion';

	protected $primaryKey = 'ID_Clasf';

	protected $fillable=['ClasfCode', 'ClasfDescription'];

    public function tratamientos()
    {
        return $this->belongsToMany('App\Tratamiento','clasificacion_tratamiento', 'FK_Clasf', 'FK_Trat')
        ->join('sedes', 'sedes.ID_Sede', '=', 'tratamientos.FK_TratProv')
        ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
        ->select('sedes.*', 'clientes.*', 'tratamientos.*');
        //lista los tratamientos relacionados usando muchos a muchos
    }
}
