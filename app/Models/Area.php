<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
     protected $table = 'area';
     protected $fillable = ['name','country_id','city_id','latitude','longitude'];

   public function city_detail(){
    	return $this->belongsTo(\App\Models\City::class,'city_id','id');
   }

	public static function get_city_area_stores($country_id,$latitude,$longitude){
		return Self::where(['country_id' => $country_id])
			->with('city_detail')
			->get();
	}
}
