<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $table = 'Tratamientos';

    protected $fillable= ['TratName', 'TratTipo'];

    protected $primarykey = 'ID_Trat';

    public function Sedes()
    {
        return $this->belongsTo('App\sede', 'ID_Sede', 'id');
    }

}
