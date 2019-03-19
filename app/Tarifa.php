<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    protected $table = 'tarifas';

    protected $fillable= ['TarifaTipounidad1', 'TarifaPesoinicial1', 'TarifaPesofinal1', 'TarifaPrecio1', 'TarifaTipounidad2', 'TarifaPesoinicial2', 'TarifaPesofinal2', 'TarifaPrecio2', 'TarifaTipounidad3', 'TarifaPesoinicial3', 'TarifaPesofinal3', 'TarifaPrecio3', 'FK_TarifaTrat'];

    protected $primarykey = 'ID_Tarifa';

    public function Respel(){
    	return $this->belongsTo('App\Tratamiento', 'ID_Trat');
    }
}
