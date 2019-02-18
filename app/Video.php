<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    protected $table = ['VideoName', 'VideoTipo', 'VideoTipoOther','VideoTipoOther', 'VideoSrc' 'VideoFormat'];

    public $primaryKey = 'ID_Video';

    public function ResEnvios()
    {
    	return $this>belongsTo('ResEnvio','ID_ResEnv');
    }
}
