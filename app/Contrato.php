<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
	protected $table='contratos';
	protected $fillable=['ContraPdf', 'ContraVigencia', 'ContraNotifiVigencia', 'Fk_ContraCli', 'ContraDelete'];
	protected $primaryKey = 'ID_Contra';


	public function clientes()
	{
	return $this->belongsTo('App\Cliente','Fk_ContraCli', 'ID_Cli');
	}
}
