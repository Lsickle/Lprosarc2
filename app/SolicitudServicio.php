<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudServicio extends Model
{
    protected $table='solicitud_servicios';

    protected $fillable=['SolSerStatus', 'SolSerTipo', 'SolSerFrecuencia',' SolSerAuditable', 'SolSerConducExter','SolSerVehicExter', 'SolSerSlug', 'Fk_SolSerTransportador', 'FK_SolSerCliente', 'FK_SolSerPersona','SolSerDelete', 'created_at', 'updated_at', 'SolSerCityTrans', 'FK_SolSerCollectMun' ,'SolSerRMs', 'SolSerTranspPrecio'];
    protected $primaryKey = 'ID_SolSer';
    	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'SolSerSlug';
	}
	// especificar foránea del modelo sede
	public function sedes()
	{
	 return $this->belongsTo('App\Sede', 'ID_Sede');
	}
	public function municipio()
	{
	 return $this->belongsTo('App\Municipio', 'SolSerCityTrans', 'ID_Mun');
	}
	// especificar foranea del modelo GenerSede
	public function GenerSedes()
	{
	 return $this->belongsTo('App\GenerSede', 'ID_GSede');
	}
	public function Personal()
	{
	 	return $this->belongsTo('App\Personal', 'FK_SolSerPersona', 'ID_Pers');
	}
	public function Certificado(){
		return $this->hasMany('App\Certificado', 'ID_Cert','id');//como solicitud de servicio tiene muchos certificados
	}
	public function CertificadoExpress(){
		return $this->hasMany('App\CertificadoExpress', 'ID_Cert','id');//como solicitud de servicio tiene muchos certificados
	}
	public function Manifiesto(){
		return $this->hasMany('App\Manifiesto', 'ID_Manif', 'id');//como solicitud de servicio tiene muchos manifiestos
	}
	public function SolicitudResiduo(){
		return $this->hasMany('App\SolicitudResiduo', 'FK_SolResSolSer', 'ID_SolSer');//como solicitud de servicio tiene muchas solicitud de residuos
	}
	public function ResiduosGener(){
		return $this->hasMany('App\ResiduosGener', 'ID_SGenerRes', 'id');
	}
	public function ManifiestoCarga(){
		return $this->hasMany('App\ManifiestoCarga','ID_ManiCarg','id');//como solicitud de servicio tiene muchos manifiesto de carga
	}
	public function Observaciones(){
		return $this->hasMany('App\Observacion', 'FK_ObsSolSer', 'ID_SolSer');//como solicitud de servicio tiene muchas observaciones
	}

	/*consulta para with de documentos*/
	public function documentos()
	{
		return $this->hasMany('App\Documento', 'FK_CertSolser', 'ID_SolSer');
	}

	/*consulta para with de manifiestos*/
	public function manifiestos()
	{
		return $this->hasMany('App\Manifiesto', 'FK_ManifSolser', 'ID_SolSer');
	}

	// especificar foranea del modelo sede
	public function cliente()
	{
	 return $this->belongsTo('App\Cliente', 'FK_SolSerCliente', 'ID_Cli');
	}

	public function programaciones()
	{
		return $this->hasMany('App\ProgramacionVehiculo', 'FK_ProgServi', 'ID_SolSer');
	}

	public function programacionesrecibidas()
	{
		return $this->programaciones()->whereNotNull('ProgVehEntrada')->where('ProgVehDelete', 0);
	}

	public function ultimorecordatorio()
	{
		return $this->Observaciones()->where('ObsStatus', 'Recordatorio+')->orderBy('ObsDate', 'desc')->first();
	}

	public function fechacompletado()
	{
		return $this->Observaciones()->where('ObsStatus', 'Completado')->orderBy('ObsDate', 'desc')->first();
	}

    public function recibosdepago()
	{
        return $this->belongsTo('App\ReciboDePago', 'FK_ReciboSolserv', 'ID_Recibo');
	}

	protected $casts = [
        'SolSerRMs' => 'array',
    ];
}
