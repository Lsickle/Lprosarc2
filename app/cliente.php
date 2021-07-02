<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	protected $table = 'clientes';

	protected $fillable = ['CliNit', 'CliName', 'CliShortname', 'CliCode','CliType', 'CliCategoria','CliAuditable', 'CliSlug' ,'CliDelete', 'ID_Cli', 'TipoFacturacion'];

	protected $primaryKey = 'ID_Cli';
	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
		return 'CliSlug';
	}

	public function sedes()
	{
		return $this->hasMany('App\Sede', 'FK_SedeCli', 'ID_Cli');//como cliente tiene muchas sedes el busca automaticamente el campo negocios_id
	}
	public function contratos()
	{
		return $this->hasMany('App\Contrato', 'ID_Contra', 'ID_Cli');//como cliente tiene muchos contratos
	}
	public function requerimientos()
	{
		return $this->hasOne('App\RequerimientosCliente', 'ID_RequeCli', 'ID_Cli');//como cliente tiene solo unos requerimientos
	}

	public function manifiestos(){
		return $this->hasMany('App\Manifiesto','FK_ManifCliente', 'ID_Cli');
    }

    public function manifiestosdegestor(){
		return $this->hasMany('App\Manifiesto','FK_ManifTransp', 'ID_Cli');
    }

    public function manifiestosdetransportador(){
		return $this->hasMany('App\Manifiesto','FK_ManifGestor', 'ID_Cli');
    }

    public function certificados(){
		return $this->hasMany('App\Manifiesto','FK_CertCliente', 'ID_Cli');
    }

    public function certificadosdegestor(){
		return $this->hasMany('App\Manifiesto','FK_CertTransp', 'ID_Cli');
    }

    public function certificadosdetransportador(){
		return $this->hasMany('App\Manifiesto','FK_CertGestor', 'ID_Cli');
    }

	public function comercialAsignado(){
		return $this->hasOne('App\Personal','ID_Pers', 'CliComercial');
    }

	public function clientetarifa(){
		return $this->hasMany('App\CTarifa','FK_Cliente', 'ID_Cli');
	}
}
