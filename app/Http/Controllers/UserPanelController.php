<?php

namespace App\Http\Controllers;
use \App\User;
use \App\Models\Category;
use \App\Models\Country;
use \App\Models\City;
use \App\Models\Area;
use \App\Models\RecentStores;
use \App\Models\StoreType; // cuisine type
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Hash;
use DB;
use Response;

class UserPanelController extends Controller
{
	public function login(Request $request){
		// session()->pull('mai_store_loggedin');
		if($request->method() == 'GET'){
			if(session('mai_store_loggedin')){
				$category = Category::all();
				$country = Country::all();
				$StoreId = session('mai_user_id');
				$user_detail = User::find(['id' => $StoreId ,'user_type' => 2])->first();	
				// return $user_detail;
				$city_list = "";
				$area_list = "";
				if($user_detail->store_city){
					$city_list = City::where(['country_id' => $user_detail->store_country])->get();
					$area_list = Area::where(['country_id' => $user_detail->store_country,'city_id' => $user_detail->store_city])->get();
				}
				return view('UserPanel/storeDetail',compact('category','country','user_detail','city_list','area_list'));
				// return redirect('UserPanel/index');
			}else{
				return view('UserPanel/home');
			}
		}
		if($request->method() == 'POST'){
			$validations = [
				'login_email' => 'required|email',
				'login_password' => 'required',
			];
			$Validator = Validator::make($request->all(),$validations);
			if($Validator->passes()){
				$remember = $request->loginkeeping;
				$email = $request->login_email;
				$password = $request->login_password;
				$user_detail = User::where(['email' => $email,'user_type' => 2])->first();
				if($user_detail){
					if(Hash::check($password,$user_detail->password)){
						$session_data = [
							'user_detail' => $user_detail,
							'mai_store_loggedin' => true,
							'mai_user_type' => 2,
							'mai_user_id' => $user_detail->id,
						];
						if($remember=='on') {
							setcookie('mai_user_panel_login_email',$email, time() + (86400 * 30), "/");
							setcookie('mai_user_panel_login_password',$password, time() + (86400 * 30), "/");
							setcookie('mai_user_panel_loginkeeping','on',time() + (86400 * 30), "/");
						}
						if($remember!='on') {
							setcookie('mai_user_panel_login_email', null, -1, '/');
							setcookie('mai_user_panel_login_password', null, -1, '/');
							setcookie('mai_user_panel_loginkeeping', null, -1, '/');
						}
						Session::put($session_data);
						return redirect('UserPanel/index');
					}else{
						return redirect()->back()->with('invalid_password','Invalid password.');
					}
				}else{
					return redirect()->back()->with('invalid_detail','Invalid email or password.');
				}
			}else{
				return redirect('UserPanel/login')->withErrors($Validator)->withInput();
			}
		}
	}

	public function index(Request $request){
		if($request->method() == 'GET'){
			if(Session::get('mai_store_loggedin') == true){
				$category = Category::all();
				$country = Country::all();
				$StoreId = session('mai_user_id');
				// dd($StoreId);
				$user_detail = User::where(['id' => $StoreId ,'user_type' => 2])->first();	
				// return $user_detail;
				$Store_nationality_Type = StoreType::all();
				return view('UserPanel/storeDetail',compact('category','country','user_detail','city_list','area_list','Store_nationality_Type'));
			}else{
				return redirect('UserPanel/login');
			}
		}
	}

	public function sign_up(Request $request){
		if($request->method() == 'GET'){
			if(session('mai_store_loggedin')){
				return redirect('UserPanel/index');
			}else{
				return view('UserPanel/home');
			}
		}

		if($request->method() == 'POST'){
			$email = $request->email;
			$password = $request->password;

			$validations = [
				'email' => 'required|email|unique:users',
				'password' => 'required',
				'confirm_password' => 'required|same:password',
			];
			$Validator = Validator::make($request->all(),$validations);
			if($Validator->passes()){
				$user_detail = User::firstOrCreate(['email' => $email , 'user_type' => 2 , 'password' => Hash::make($password)]);
				if($user_detail){
					$user_detail->created_at = time();
					$user_detail->updated_at = time();
					$user_detail->save();
					$session_data = [
						'user_detail' => $user_detail,
						'mai_store_loggedin' => true,
						'mai_user_type' => 2,
						'mai_user_id' => $user_detail->id,
					];
					Session::put($session_data);
					if(Session::get('mai_store_loggedin')){
						return redirect('UserPanel/index');
					}else{

					}
				}else{
					return redirect('UserPanel/sign_up');
				}
			}else{
				return redirect('UserPanel/sign_up')->withErrors($Validator)->withInput();
			}
		}
	}

	public function logout(Request $request){
		/*$session_data = [
			'mai_store_loggedin' => false,
			'mai_user_type' => '',
			'mai_user_id' => '',
		];
		Session::put($session_data);*/
		$user_id = Session::get('mai_user_id');
		$userDetail = User::find($user_id);
		if($userDetail){
			$session_data = [
				'mai_store_loggedin' => false,
				'mai_user_type' => '',
				'mai_user_id' => '',
			];
			Session::put($session_data);
			if(Session::get('mai_store_loggedin') == false){
				return redirect('/UserPanel/login');
			}else{
				$session_data = [
					'mai_store_loggedin' => true,
					'mai_user_type' => 2,
					'mai_user_id' => $userDetail->id,
				];
				Session::put($session_data);
				return redirect('UserPanel/index');
			}
		}
	}

	public function forget_password(Request $request){
		if($request->method() == 'GET'){
			return view('UserPanel/home');
		}

		if($request->method() == 'POST'){
			
		}
	}

	public function store_detail(Request $request){
		if($request->method() == 'POST'){
			// dd($request->all());
			// dd($request->all());
			////////////////////
			///	FOR API USES
			///////////////////
				if($request->type == 'api'){
					$user_detail = User::find(['id' => $request->store_id])->first();
					$result = [];
					if($user_detail->store_country && $user_detail->store_city && $user_detail->store_area){
						$result = [
							'store_country' => $user_detail->store_country,
							'store_country_name' => Country::where(['id' => $user_detail->store_country])->first()->name,
							'store_city' => $user_detail->store_city,
							'store_city_name' => City::where(['id' => $user_detail->store_city])->first()->name,
							'store_area' => $user_detail->store_area,
							'store_area_name' => Area::where(['id' => $user_detail->store_area])->first()->name,
						];
					}
					return $result;
				}
			///////////////////////
			///	FOR API USES END
			///////////////////////

			$destinationPathOfLogo = base_path().'/'.'UserPanel/store_logo';
			$destinationPathOfCoverPic = base_path().'/'.'UserPanel/store_cove_pic';
			$validations = [
				'store_name'=>'required',
				'owner_name'=>'required',
				'phone_number'=>'required',
				'country_name'=>'required',
				'city_name'=>'required',
				'area_name'=>'required',
				'store_cuisine_type' => 'required',
				'store_type' => 'required',
				// 'logo'=>'required|mimes:jpeg,bmp,png',
				// 'logo'=>'required|image',
				// 'cover_pic'=>'required|image',
				'address'=>'required',
			];
			$Validator = Validator::make($request->all(),$validations);
			if($Validator->passes()){
				// dd($request->all());
				$city_table_detail = City::firstOrCreate(['name' => $request->city_name , 'country_id' => $request->country_name]);
				$area_table_detail = Area::firstOrCreate(['name' => $request->area_name, 'country_id' => $request->country_name, 'city_id' => $city_table_detail->id , 'latitude' => $request->latitude , 'longitude' => $request->longitude]);
				$store_cuisine_type = StoreType::firstOrCreate(['name' => $request->store_cuisine_type,'store_type' => $request->store_type]);
				// dd($store_cuisine_type);

				$logo = $request->file('logo');
				$cover_pic = $request->file('cover_pic');
				$StoreId = session('mai_user_id');
				$user_detail = User::find(['id' => $StoreId])->first();
				$user_detail->store_name = $request->store_name;
				$user_detail->store_owner_name = $request->owner_name;
				$user_detail->mobile = $request->phone_number;
				$user_detail->store_country = $request->country_name;
				$user_detail->store_city = $city_table_detail->id;
				$user_detail->store_area = $area_table_detail->id;
				$user_detail->store_type = $request->store_type;
				$user_detail->complete_profile_status = 1;
				$user_detail->store_address = $request->address;
				$user_detail->store_cuisine_type = $store_cuisine_type->id;
				if(!empty($logo)){
					if(!empty($user_detail->store_logo) && file_exists(base_path().'/'.'UserPanel/store_logo/'.$user_detail->store_logo) ){
						unlink(base_path().'/'.'UserPanel/store_logo/'.$user_detail->store_logo);
					}
					$fileName = time()."_".$logo->getClientOriginalName();
					$logo->move( $destinationPathOfLogo , $fileName );
					$user_detail->store_logo = $fileName;
				}
				if(!empty($cover_pic)){
					if(!empty($user_detail->store_cover_pic) && file_exists(base_path().'/'.'UserPanel/store_cove_pic/'.$user_detail->store_cover_pic) ){
						unlink(base_path().'/'.'UserPanel/store_cove_pic/'.$user_detail->store_cover_pic);
					}
					$fileName = time()."_".$cover_pic->getClientOriginalName();
					$cover_pic->move( $destinationPathOfCoverPic , $fileName );
					$user_detail->store_cover_pic = $fileName;
				}
				$user_detail->save();
				return redirect()->back()->with('detail_updated','Store Detail Updated Successfully.');
			}else{
				return redirect()->back()->withInput()->withErrors($Validator); 
			}
		}
	}















	/////////////////////////////////////////////////
	//////    API's
	/////////////////////////////////////////////////

	public function home_data(Request $request){
     	$category_list = Category::all();
     	$recent_stores = RecentStores::all();
     	$latitude = $request->latitude;
     	$longitude = $request->longitude;
     	$country_name = '';
     	$country_id = "";

     	$validations = [
			'latitude' => 'required',
			'longitude' => 'required',
		];
		$Validator = Validator::make($request->all(),$validations);
    	if($Validator->fails()){
    		$response = [
			'message' => $Validator->errors($Validator)->first()
			];
			return response()->json($response,trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
    	}

    	/*if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){
			$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($_POST['latitude']).','.trim($_POST['longitude']).'&sensor=false';
			$json = @file_get_contents($url);
			$data = json_decode($json);
			if(!empty($data) && !empty($data->results[0]) )
			{
				$data =$data->results[0]->address_components;
				foreach ($data as $key => $value) {
					if( $value->types[0] == 'country'){
						$country_name = $value->long_name;
					}
				}
			}
		}
		if($country_name){
			$country_data = Country::where(['name' => $country_name])->first();
			if($country_data){
				$country_id = $country_data->id;
			}
		}*/
		// dd($country_id);
    	// dd($this->store_list_by_latlong($latitude,$longitude));

		$store_list = $this->store_list_by_latlong($latitude,$longitude);

		foreach ($store_list as $key => $value) {
    		$distance_count = $this->distance($value->store_area->latitude,$value->store_area->longitude,$latitude,$longitude,"K");
    		$result []= $value;
    		$result [$key]['distance_count']= $distance_count;
    	}

     	$response = [
     		'message' => __('messages.success.success'),
     		// 'country_id' => $country_id,
     		'category_list' => $category_list,
     		'store_list' => $result,
     		'recent_stores' => $recent_stores
     	];
     	return response()->json($response,__('messages.statusCode.ACTION_COMPLETE'));
 	}

 	public function get_data_by_category(Request $request){
 		// dd($request->all());
 		$category_id = $request->category_id;
 		$country_id = $request->country_id;
 		$latitude = $request->latitude;
     	$longitude = $request->longitude;

 		$validations = [
			'category_id' => 'required',
			'country_id' => 'required',
			'latitude' => 'required',
			'longitude' => 'required',
		];
		$Validator = Validator::make($request->all(),$validations);
    	if($Validator->fails()){
    		$response = [
			'message' => $Validator->errors($Validator)->first()
			];
			return response()->json($response,trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
    	}
    	$near_you = count($this->store_list_by_latlong($latitude,$longitude));
    	// $Store_list = User::where(['complete_profile_status' => 1 , 'user_type' => 2 , 'store_country' => $country_id])->get();
    	$city_list = City::where(['country_id' => $country_id])->get();
    	$result1 = [];
    	$result2 = [];
    	// return $city_list;
    	foreach ($city_list as $key => $value) {
    		$result1[]= [
    			'country_id' => $value->country_id,
    			'country_name' => Country::where('id',$value->country_id)->first()->name,
    			'city_id' => $value->id,
    			'city_name' => $value->name,
    			'store_under_city' => User::where(['complete_profile_status'=>1, 'user_type'=>2,'store_country'=>$value->country_id,'store_city'=>$value->id ,'store_type' => $category_id])->count(),
    			'area_list' => Area::where(['city_id' => $value->id, 'country_id' => $value->country_id])->select('id','name','latitude','longitude')->get()
    		];
    		// dd($value);
    	}

    	// return $result1;

    	foreach ($result1 as $key => $value) {
    		$area_detail_and_stores_count = [];
    		foreach ($value['area_list'] as $key => $value1) {
    			// dd($value1);
    			$area_detail_and_stores_count[] = [
	    			'area_id' => $value1->id,
	    			'area_name' => $value1->name,
	    			'latitude' => $value1->latitude,
	    			'longitude' => $value1->longitude,
	    			'store_under_area' => User::where(['complete_profile_status'=>1, 'user_type'=>2,'store_country'=>$value['country_id'],'store_city'=>$value['city_id'],'store_area' => $value1->id , 'store_type' => $category_id])->count()
	    		];
    		}
    		
    		$result2[] = [
    			'country_id' => $value['country_id'],
    			'country_name' => $value['country_name'],
    			'city_id' => $value['city_id'],
    			'city_name' => $value['city_name'],
    			'store_under_city' => $value['store_under_city'],
    			'area_list' => $area_detail_and_stores_count
    		];
    	}
    	// return $result2;
    	// return Area::get_city_area_stores($country_id,$latitude,$longitude);
    	// return City::get_city_area_stores($country_id,$latitude,$longitude);

 		$response = [
 			'message' => __('messages.success.success'),
 			'near_you' => $near_you,
 			'result' => $result2
 		];
		return response()->json($response,__('messages.statusCode.ACTION_COMPLETE'));
 	}

 	public function store_list_by_latlong($latitude,$longitude,$dis = null){
 		if($dis){
 			$distance = (int)$dis;
 		}else{
 			$distance = 2;
 		}
 		$DATA = DB::select("SELECT *,(3959 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos( radians(longitude) - radians($longitude)) + sin(radians($latitude)) * 
                    sin(radians(latitude))))  AS distance FROM  area HAVING distance < $distance ");
     	$countryArr = [];
     	$cityArr = [];
     	$areaArr = [];
     	foreach ($DATA as $key => $value) {
     		if(!in_array($value->country_id, $countryArr)){
     			array_push($countryArr, $value->country_id);
     		}
     		
     		if(!in_array($value->city_id, $cityArr)){
     			array_push($cityArr, $value->city_id);
     		}

     		if(!in_array($value->id, $areaArr)){
     			array_push($areaArr, $value->id);
     		}
     	}
     	$store_list = User::whereIn('store_country',$countryArr)
     		->whereIn('store_city',$cityArr)
     		->whereIn('store_area',$areaArr)
     		->where('user_type',2)
     		->get();
     	return $store_list;
 	}

 	public function sort_data(Request $request){
 		$validations = [
			'category_id' => 'required',
			'country_id' => 'required',
			'latitude' => 'required',
			'longitude' => 'required',
			'city_id' => 'required',
			'area_id' => 'required',
			'sort_type' => 'required'
		];
		$Validator = Validator::make($request->all(),$validations);
    	if($Validator->fails()){
    		$response = [
				'message' => $Validator->errors($Validator)->first()
			];
			return response()->json($response,trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
    	}

    	$latitude = $request->latitude;
    	$longitude = $request->longitude;
    	$category_id = $request->category_id;
    	$country_id = $request->country_id;
    	$city_id = $request->city_id;
    	$area_id = $request->area_id;
		$sort = [];
    	$area_id_arr = [];
    	$area_id_data = Area::find($area_id);

    	if($area_id_data){
    		$area_id_arr = Area::where(['name' => $area_id_data->name , 'country_id' => $country_id])->pluck('id');
    	}
    	$store_list = User::where(['store_country' => $country_id, 'store_city' => $city_id , 'complete_profile_status' => 1 ,'store_type' => $category_id])->whereIn('store_area',$area_id_arr)->get();
    	
    	$result = [];

    	if($request->sort_type == 1 ){ // store name sort
	    	foreach ($store_list as $key => $value) {
	    		$distance_count = $this->distance($value->store_area->latitude,$value->store_area->longitude,$latitude,$longitude,"K");
	    		$sort[$key] = $value->store_name;
	    		$result []= $value;
	    		$result [$key]['distance_count']= $distance_count;
	    	}
	    	array_multisort($sort, SORT_ASC, $result);
	    	$response = [
	    		'messages' => __('messages.success.success'),
	    		'response' => $result
	    	];
	    	return response()->json($response,200);
	   }

	   if($request->sort_type == 2 ){ // store cuisine sort
	    	foreach ($store_list as $key => $value) {
	    		$distance_count = $this->distance($value->store_area->latitude,$value->store_area->longitude,$latitude,$longitude,"K");

	    		$sort[$key] = $value->store_cuisine_type->name;
	    		$result []= $value;
	    		$result [$key]['distance_count']= $distance_count;
	    	}
	    	array_multisort($sort, SORT_ASC, $result);
	    	$response = [
	    		'messages' => __('messages.success.success'),
	    		'response' => $result
	    	];
	    	return response()->json($response,200);
	   }

		if($request->sort_type == 3 ){ // store cuisine sort
	    	foreach ($store_list as $key => $value) {
	    		$distance_count = $this->distance($value->store_area->latitude,$value->store_area->longitude,$latitude,$longitude,"K");

	    		$sort[$key] = $distance_count;
	    		$result []= $value;
	    		$result [$key]['distance_count']= $distance_count;
	    	}
	    	array_multisort($sort, SORT_ASC, $result);
	    	$response = [
	    		'messages' => __('messages.success.success'),
	    		'response' => $result
	    	];
	    	return response()->json($response,200);
	   }


 	}

 	function distance($lat1, $lon1, $lat2, $lon2, $unit) {
	  $theta = $lon1 - $lon2;
	  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	  $dist = acos($dist);
	  $dist = rad2deg($dist);
	  $miles = $dist * 60 * 1.1515;
	  $unit = strtoupper($unit);

	  if ($unit == "K") {
	    return ($miles * 1.609344);
	  } else if ($unit == "N") {
	      return ($miles * 0.8684);
	    } else {
	        return $miles;
	      }
	}
}
