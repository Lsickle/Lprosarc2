<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';

    protected $fillable = ['DocType', 'DocNumero', 'DocEspName'. 'DocEspValue', 'DocObservacion', 'DocSrc', 'DocSlug', 'DocNumRm', 'DocAuthHseq', 'DocAuthJl', 'DocAuthDp', 'DocAnexo', 'FK_CertSolser'];

    protected $primaryKey = 'ID_Doc';

    public function servicio()
    {
    	return $this->belongsTo('App\SolicitudServicio', 'FK_CertSolser', 'ID_SolSer');
    }

    // consulta para with de datos de residuos
    public function docdato()
    {
    	return $this->hasMany('App\Docdato', 'FK_DatoDoc', 'ID_Doc');
    }
}
