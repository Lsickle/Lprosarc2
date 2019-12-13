<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResiduosGener extends Model
{
    protected $table = 'residuos_geners';

    protected $fillable = ['FK_SGener', 'FK_Respel', 'SlugSGenerRes', 'DeleteSGenerRes'];

    protected $primaryKey = 'ID_SGenerRes';

    public function gener_sedes()
	{
	 return $this->belongsTo('App\GenerSede', 'FK_SGener', 'ID_GSede');
	}
    public function respels()
	{
	 return $this->belongsTo('App\Respel','FK_Respel', 'ID_Respel');
	}

	public function solres()
	{
	 return $this->hasMany('App\SolicitudResiduo', 'FK_SolResRg', 'ID_SGenerRes');
	}
}
