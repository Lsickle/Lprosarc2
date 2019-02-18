<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataDefinition extends Model
{
    protected $table='data_definitions';

    protected $fillable=['DatoName', 'DatoDescrip', 'DatoAlias', 'DatoTipo', 'DatoLongi',' DatoEstructura', 'DatoRelacion'];

    protected $primaryKey = 'ID_Dato';
 
}
