<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    protected $table = 'clasificacion';

	protected $primaryKey = 'ID_Clasf';

	protected $fillable=['ClasfCode', 'ClasfDescription', 'FK_Clasftrat'];

    public function tratamientos()
    {
        return $this->belongsToMany('App\Tratamiento','clasificacion_tratamiento', 'FK_Clasf', 'FK_Trat');
        //lista los tratamientos relacionados usando muchos a muchos
    }
}
