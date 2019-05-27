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
	 return $this->belongsTo('App\GenerSede','FK_SGener', 'ID_GSede');
	}
    public function respels()
	{
	 return $this->belongsTo('App\GenerSede','FK_Respel', 'ID_Respel');
	}
}
