<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticuloPorProveedor extends Model
{
    protected $table = 'articulo_por_proveedors';

	protected $fillable = ['ArtiUnidad', 'ArtiCant', 'ArtiPrecio', 'ArtiCostoUnid', 'ArtiMinimo', 'FK_ArtCotiz', 'FK_ArtiActiv', 'FK_AutorizedBy'];
	
	protected $primaryKey = 'ID_ArtiProve';

    public function user()
    {
    	return $this->belongsTo('App\User', 'id');
    }

    public function activo()
    {
    	return $this->belongsTo('App\Activo', 'ID_Act', 'id');
    }

    public function Quotation()
    {
        return $this->belongsTo('App\Quotation', 'ID_Cotiz', 'id');
    }
}
