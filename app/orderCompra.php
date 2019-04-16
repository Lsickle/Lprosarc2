<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCompra extends Model
{
    protected $table = 'ordencompras';

    protected $fillable = ['OrdenNum', 'OrdenStatus', 'OrdenInvoice', 'OrdenRecibida', 'OrdenPagada', 'OrdenTotal', 'OrdenAutor'];

    protected $primaryKey = 'ID_Orden';

    public function User(){
    	return $this->belongsTo('App\User', 'id');
    }
    public function ProgVehiculo(){
    	return $this->belongsTo('App\ProgramacionVehiculo', 'ID_ProgVeh');
    }
    public function Quotation(){
        return $this->hasMany('App\Quotation', 'ID_Cotiz', 'id');
    }
}
