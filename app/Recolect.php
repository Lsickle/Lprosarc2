<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recolect extends Model
{
    protected $table = 'recolect';

    protected $fillable = ['FK_ColectSgen', 'FK_ColectProg', 'updated_at'];

    protected $primaryKey = 'ID_Colect';

    public function programacion()
    {
    	return $this->belongsTo('App\ProgramacionVehiculo', 'FK_ColectProg', 'ID_ProgVeh');
    }

    public function sedegen()
    {
    	return $this->belongsTo('App\GenerSede', 'FK_ColectSgen', 'ID_GSede');
    }
}
