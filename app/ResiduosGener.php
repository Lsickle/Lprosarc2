<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResiduosGener extends Model
{
    protected $table = 'residuos_geners';

    protected $fillable = ['FK_SGener', 'FK_Respel', 'FK_SolSer'];

    protected $primaryKey = 'ID_SGenerRes';

    public function gener_sedes()
	{
	 return $this->belongsTo('App\GenerSede', 'ID_GSede', 'id');
	}
    public function Respel()
	{
	 return $this->belongsTo('App\GenerSede', 'ID_Respel', 'id');
	}
}
