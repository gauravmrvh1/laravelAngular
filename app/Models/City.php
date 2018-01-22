<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city';
    protected $fillable = ['name','country_id'];

   /* public function store_under_city(){
    	return $this->belongsTo(\App\User::class,'id','store_city');
    }

    public static function get_city_area_stores($country_id,$latitude,$longitude){
    	return Self::where(['country_id' => $country_id])
    		->with('store_under_city')
    		->get();
    }*/
}
