<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table = 'cotizacions';

    protected $fillable= ['CotiNumero', 'CotiFechaSolicitud', 'CotiFechaRespuesta', 'CotiFechaVencimiento', 'CotiVencida', 'CotiPrecioTotal', 'CotiPrecioSubtotal', 'FK_CotiSede', 'CotiDelete'];

    protected $primarykey = 'ID_Coti';

    public function Sede()
	{
	 return $this->belongsTo('App\Cotizacion', 'ID_Sede', 'id');
	}
}
