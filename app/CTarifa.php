<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CTarifa extends Model
{
    protected $table = 'clientetarifa';

    protected $fillable= ['TarifaDelete', 'TarifaVencimiento', 'TarifaFrecuencia', 'Tarifatipo', 'FK_Tratamiento', 'FK_Cliente'];

    protected $primaryKey = 'ID_CTarifa';

    public function cliente(){
    	return $this->belongsTo('App\Cliente', 'FK_Cliente', 'ID_Cli');
    }

    public function tratamiento(){
    	return $this->belongsTo('App\Tratamiento', 'FK_Tratamiento', 'ID_Trat');
    }

    public function rangos(){
    	return $this->hasMany('App\TRangos', 'FK_RangoCTarifa', 'ID_CTarifa')->orderBy('CTarifaDesde', 'desc');
    }


}
