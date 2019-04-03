<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    protected $table = 'tarifas';

    protected $fillable= ['TarifaTipounidad1', 'TarifaPesoinicial1', 'TarifaPesofinal1', 'TarifaPrecio1', 'TarifaTipounidad2', 'TarifaPesoinicial2', 'TarifaPesofinal2', 'TarifaPrecio2', 'TarifaTipounidad3', 'TarifaPesoinicial3', 'TarifaPesofinal3', 'TarifaPrecio3', ];

    protected $primaryKey = 'ID_Tarifa';

    public function Requerimiento(){
    	return $this->hasOne('App\Requerimiento', 'ID_Req');
    }
}
