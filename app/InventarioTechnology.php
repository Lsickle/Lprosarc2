<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventarioTechnology extends Model{
 protected $table='inventario_technologies';
    protected $fillable = ['TecnBrand','TecnModel','TecnSerial','TecnNumber','TecnOs','TecnRam','TecnScreen','TecnAccessory1','TecnAccessory2','Tecnobserv'];
    protected $primaryKey = 'ID_Tecn';

    public function personals(){
    	return $this->belongsTo('App\Personal','ID_Pers');
    }
}
