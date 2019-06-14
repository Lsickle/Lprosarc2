<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManifiestoCarga extends Model
{
    protected $table='manifiestos_carga';
    protected $fillable = ['FK_ManiCargSolSer'];
    protected $primaryKey = 'ID_ManiCarg';

    public function SolicitudServicio(){
    	return $this->belogsTo('App\SolicitudServicio','ID_SolSer');
    }
}
