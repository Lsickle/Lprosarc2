<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'Quotations';

    protected $fillable = ['CotizNum', 'CotizStatus', 'CotizSubTotal'];

    protected $primaryKey = 'ID_Cotiz';

    public function Sede(){
    	return $this->belongsTo('App\Sede', 'ID_Sede');
    }
    public function OrdenCompra(){
    	return $this->belongsTo('App\OrderCompra','ID_Orden');
    }
    public function ArticuloProv(){
    	return $this->hasMany('App\ArticuloPorProveedor','ID_ArtiProve', 'id'); //Como cotizacion tiene muchos articulos de proveedor
    }
}
