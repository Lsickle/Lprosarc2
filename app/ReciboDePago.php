<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReciboDePago extends Model
{
    protected $table='recibo_de_pagos';

    protected $fillable=['fecha_de_pago', 'monto', 'medio_de_pago', 'url_comprobante', 'url_recibo', 'ReciboSlug'];

    protected $primaryKey = 'ID_Recibo';

    public function getRouteKeyName()
	{
	    return 'ReciboSlug';
    }

	public function servicios()
	{
	    return $this->hasMany('App\SolicitudServicio', 'FK_ReciboSolserv', 'ID_Recibo');
	}

}
