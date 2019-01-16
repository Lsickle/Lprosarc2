<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users(){
    	return $this->belongsToMany('App/User');
    }

    protected $fillable = [
        'name', 'descripcion', 'UsSlug'
    ];



    /**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
    public function getRouteKeyName()
	{
	    return 'UsSlug';
	}


}
