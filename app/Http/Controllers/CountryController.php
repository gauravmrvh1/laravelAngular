<?php

namespace App\Http\Controllers;
use \App\Models\Country;
use \App\Models\City;
use \App\Models\Area;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function create(Request $request){
   	$country = json_decode($request->country);
   	foreach ($country as $key => $value) {
   		// dd($value);
   		$data = Country::firstOrNew(['name'=>$value]);
   		$data->created_at = time();
   		$data->updated_at = time();
   		$data->save();
   	}
   	$response = [
   		'message' => 'Success',
   		'response' => Country::all()
   	];
   	return response()->json($response,__('messages.statusCode.ACTION_COMPLETE'));
   }

   public function get_city_uder_country(Request $request){
   	$store_country_id = $request->store_country_id;
   	return City::where(['country_id' => $store_country_id])->get(); 
   }

   public function get_area_uder_city(Request $request){
   	$city_id = $request->city_id;
   	$country_id = $request->store_country;
   	return Area::where(['country_id' => $country_id , 'city_id' => $city_id])->get(); 
   }
}
