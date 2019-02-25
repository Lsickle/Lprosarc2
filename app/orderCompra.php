<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCompra extends Model
{
    protected $table = 'OrdenCompras';

    protected $fillable = ['OrdenNum', 'OrdenStatus', 'created_at', 'updated_at', 'OrdenInvoice', 'OrdenRecibida', 'OrdenPagada', 'OrdenTotal', 'OrdenAutor', 'FK_OrdenCreateBy', 'FK_OrdenProg'];

    protected $primarykey = 'ID_Orden';

    public function User(){
    	return $this>belongsTo('App\User', 'id');
    }
    public function ProgVehiculo(){
    	return $this>belongsTo('App\ProgramacionVehiculo', 'ID_ProgVeh');
    }
    public function Quotation(){
        return $this>hasMany('App\Quotation', 'ID_Cotiz', 'id');
    }
}
