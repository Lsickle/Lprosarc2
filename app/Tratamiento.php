<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $table = 'Tratamientos';

    protected $fillable= ['TratName', 'TratTipo'];

    protected $primarykey = 'ID_Trat';

    public function Sedes(){
    	return $this->belongsTo('App\Sede', 'ID_Sede');
    }
    public function Respel(){
    	return $this->belongsTo('App\Respel', 'ID_Respel');
    }
}
