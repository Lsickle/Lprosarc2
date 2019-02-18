<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticuloPorProveedor extends Model
{
    protected $table = 'articulo_por_proveedors';

	protected $fillable = ['ArtiUnidad', 'ArtiCant', 'ArtiPrecio', 'ArtiCostoUnid', 'ArtiMinimo'];
	
	protected $primaryKey = 'ID_ArtiProve';

    public function user()
    {
    	return $this->belongsTo('App\User, id')
    }

    public function activo()
    {
    	return $this->belongsTo('App\Activo', 'ID_Act', 'id')
    }
}
