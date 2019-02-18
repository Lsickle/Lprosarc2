<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'fotos';

    protected $table = ['FotoName', 'FotoTipo', 'FotoTipoOther','FotoTipoOther', 'FotoSrc' 'FotoFormat'];

    public $primaryKey = 'ID_Foto';

    public function ResEnvios()
    {
    	return $this>belongsTo('ResEnvio','ID_ResEnv');
    }
}
