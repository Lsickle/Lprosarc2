<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Declaration extends Model
{
    protected $table='Declarations';

    protected $fillable=['DeclarApply', 'DeclarTipo', 'DeclarName', 'DeclarStatus', 'DeclarFrecuencia',' DeclarAuditable', 'DeclarSede', 'DeclarGenerSede', 'DeclarUser', 'DeclarSlug'];

    protected $primaryKey = 'ID_Declar';
    	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'DeclarSlug';
	}
	// especificar foranea del modelo sede
	public function sedes()
	{
	 return $this>belongsTo('sede', 'ID_Sede');
	}
	// especificar foranea del modelo GenerSede
	public function GenerSedes()
	{
	 return $this>belongsTo('GenerSede', 'ID_GSede');
	}
	// especificar foranea del modelo Users
	public function users()
	{
	 return $this>belongsTo('User', 'id');
	}
	// public function generador()
 //    {
 //        return $this->hasMany('generador', 'ID_Gener');//como sede tiene muchas generadores el busca automaticamente el campo negocios_id
 //    }
}
