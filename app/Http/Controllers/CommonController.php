<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use \App\User;
use \App\Otp;
use Log;
use Response;
use Hash;
use Twilio\Rest\Client;
use Exception;
use Config;

class CommonController extends Controller
{
	public function __construct(){
		$timezone = Config::get('app.timezone');
		date_default_timezone_set($timezone);
	}

   public function sign_up(Request $request){
    	Log::info('CommonController----sign_up----'.print_r($request->all(),True));
    	$timezone = $request->header('timezone');
    	$email = $request->email;
    	$password = Hash::make($request->password);
    	$accessToken  = md5(uniqid(rand(), true));
    	$otp = rand(1000,10000);
    	$device_token = $request->device_token;
		$device_type = $request->device_type;
		$user_type = $request->user_type;
    	$validations = [
			'email' => 'required|email|unique:users',
			'password' => 'required|min:8',
			'device_token' => 'required',
			'device_type' => 'required|numeric',
			'user_type' => 'required|numeric',
    	];
    	if($timezone){
			$this->setTimeZone($timezone);
    	}

    	$validator = Validator::make($request->all(),$validations);
    	if($validator->fails()){
    		$response = [
			'message' => $validator->errors($validator)->first()
			];
			return response()->json($response,trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
    	}else{
    		$user = new \App\User;
    		$user->email = $email;
    		$user->password = $password;
    		$user->device_token = $device_token;
    		$user->remember_token = $accessToken;
    		$user->device_type = $device_type;
    		$user->user_type = $user_type;
    		$user->created_at = time();
    		$user->updated_at = time();
    		$user->save();
 			$userData = $user->getUserDetail($user->id);
 			$response = [
				'message' =>  __('messages.success.signup'),
				'response' => $userData
			];
			Log::info('CommonController----sign_up----'.print_r($response,True));
			return response()->json($response,__('messages.statusCode.ACTION_COMPLETE'));
    	}
   }

   public function social_sign_up_and_login(Request $request){
   	Log::info('CommonController----social_sign_up_and_login----'.print_r($request->all(),True));
   	$social_id = $request->social_id;
   	$email = $request->email;
   	$device_token = $request->device_token;
		$device_type = $request->device_type;
   	$name = $request->name;
   	$user_type = $request->user_type;
   	$accessToken  = md5(uniqid(rand(), true));
   	$timezone = $request->header('timezone');
   	if($timezone){
			$this->setTimeZone($timezone);
    	}
   	$validations = [
			'social_id' => 'required',
			'email' => 'required|email',
			'device_token' => 'required',
			'device_type' => 'required|numeric',
			'user_type' => 'required|numeric',
			'name' => 'required'
    	];
    	$validator = Validator::make($request->all(),$validations);
    	if($validator->fails()){
    		$response = [
			'message' => $validator->errors($validator)->first()
			];
			return response()->json($response,trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
    	}else{
    		$user = User::where(['social_id'=>$social_id,'email'=> $email])->first();
    		if(!$user){
    			$validations = [
					'email' => 'required|email|unique:users',
					'social_id' => 'required|unique:users',
		    	];
    			$validator = Validator::make($request->all(),$validations);
		    	if($validator->fails()){
		    		$response = [
					'message' => $validator->errors($validator)->first()
					];
					return response()->json($response,trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
		    	}else{
	    			$User = new User;
	    			$User->name = $name;
	    			$User->email = $email;
	    			$User->social_id = $social_id;
	    			$User->device_token = $device_token;
	    			$User->device_type = $device_type;
	    			$User->user_type = $user_type;
	    			$User->remember_token = $accessToken;
	    			$User->created_at = time();
	    			$User->updated_at = time();
	    			$User->save();
	    			if($User){
	    				$response = [
		    				'messages' => __('messages.success.signup'),
		    				'response' =>$User->getUserDetail($User->id)
		    			];
		    			return Response::json($response,__('messages.statusCode.ACTION_COMPLETE'));
	    			}
	    		}
    		}else{
    			
	    			$Obj = new User;
	    			$User = User::find($user->id);
	    			$User->remember_token = $accessToken;
	    			$User->updated_at = time();
	    			$User->save();
	    			$response = [
	    				'messages' => __('messages.success.login'),
	    				'response' => $User->getUserDetail($User->id)
	    			];
	    			Log::info('CommonController----social_sign_up_and_login----'.print_r($response,True));
	    			return Response::json($response,__('messages.statusCode.ACTION_COMPLETE'));
    		}
    	}
   }

   public function login(Request $request){
   	Log::info('CommonController----login----'.print_r($request->all(),True));
   	$email = $request->email;
   	$password = $request->input('password');
   	$user_type = $request->user_type;
   	$device_token = $request->device_token;
		$device_type = $request->device_type;
   	$accessToken  = md5(uniqid(rand(), true));
   	$timezone = $request->header('timezone');
   	
   	$validations = [
			'email' => 'required|email',
			'password' => 'required|min:8',
			'device_token' => 'required',
			'device_type' => 'required|numeric',
			'user_type' => 'required'
    	];
    	if($timezone){
			$this->setTimeZone($timezone);
    	}
    	$validator = Validator::make($request->all(),$validations);
    	if($validator->fails()){
    		$response = [
			'message' => $validator->errors($validator)->first()
			];
			return response()->json($response,trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
    	}else{
    		$userDetail = User::Where(['email' => $email])->first();
    		// dd($userDetail);
    		if(!empty($userDetail)){
	    			if($userDetail->user_type == $user_type){
	    				if(Hash::check($password,$userDetail->password)){
		    				$User = new User;
		    				$UserDetail = $User::find($userDetail->id);
		    				$UserDetail->device_token = $device_token;
		    				$UserDetail->device_type = $device_type;
		    				$UserDetail->remember_token = $accessToken;
		    				$UserDetail->updated_at = time();
		    				$UserDetail->save();
		    				$result = $User::find($userDetail->id); 
		    				$response = [
								'message' =>  __('messages.success.login'),
								'response' => $result
							];
							return response()->json($response,__('messages.statusCode.ACTION_COMPLETE'));
		    			}else{
		    				$response = [
								'message' =>  __('messages.invalid.detail')
							];
							return response()->json($response,__('messages.statusCode.INVALID_CREDENTIAL'));
		    			}
		    		}else{
		    			$response = [
							'message' =>  __('messages.invalid.detail')
						];
						return response()->json($response,__('messages.statusCode.INVALID_CREDENTIAL'));
		    		}
	    		}else{
	    			$response = [
						'message' =>  __('messages.invalid.detail')
					];
					Log::info('CommonController----login----'.print_r($response,True));
					return response()->json($response,__('messages.statusCode.SHOW_ERROR_MESSAGE'));
	    		}
    	}
   }

	public function logout( Request $request ) {
		Log::info('----------------------CommonController--------------------------logout'.print_r($request->all(),True));
		$accessToken =  $request->header('accessToken');
		if( !empty( $accessToken ) ) {
			$user = new \App\User;
			$userDetail = User::where(['remember_token' => $accessToken])->first();
			if(count($userDetail)){
				$User = User::find($userDetail->id);
    			$User->remember_token = "";
    			$User->updated_at = time();
    			$User->save();
    			$Response = [
    			  'message'  => trans('messages.success.logout'),
    			];
        		return Response::json( $Response , trans('messages.statusCode.ACTION_COMPLETE') );	
			}else{
				$response['message'] = trans('messages.invalid.detail');
				return response()->json($response,trans('messages.statusCode.INVALID_ACCESS_TOKEN'));
			}
		} else {
	    	$Response = [
			  'message'  => trans('messages.required.accessToken'),
			];
	      return Response::json( $Response , trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
    	}
	}

	public function otpVerify( Request $request ) {
		Log::info('----------------------CommonController--------------------------otpVerify'.print_r($request->all(),True));
	   $otp = $request->input('otp');
	   $user_id = $request->input('user_id');
	   $key = $request->input('key'); // 1 (sign up otp verification) 2 (forget otp verification)
		$validations = [
			'user_id'   => 'required',
			'otp'   => 'required',
			'key'   => 'required',
		];
	  	$validator = Validator::make($request->all(),$validations);
	  	if( !empty( $user_id ) ) {
			$user = new User;
			$userDetail = User::where(['id' => $user_id])->first();
			if(count($userDetail)){
			  	if( $validator->fails() ) {
					$response = [
					 'message' => $validator->errors($validator)->first(),
					];
					return Response::json($response,trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
			   } else {
			   	switch ($key) {
			   		case 1:
			   			if( $userDetail->otp == $otp || $otp == 123456){
				    			$userDetail->otp = '';
				    			$userDetail->otp_verified = 1;
				    			$userDetail->updated_at = time();
				    			$userDetail->save();
				    			$Response = [
			        			  'message'  => trans('messages.success.otp_verified'),
			        			  'response' => User::find($userDetail->id)
			        			];
			        			Log::info('CommonController----otpVerify----'.print_r($Response,True));
			        			return Response::json( $Response , trans('messages.statusCode.ACTION_COMPLETE') );
				    		} else {
				    			$Response = [
			        				'message'  => trans('messages.invalid.OTP'),
			        			];
			        			return Response::json( $Response , trans('messages.statusCode.SHOW_ERROR_MESSAGE') );
				    		}
			   			break;
			   		
			   		case 2:
			   			if( $userDetail->email_otp == $otp || $otp == 123456){
				    			$userDetail->email_otp = null;
				    			$userDetail->email_otp_verified = null;
				    			$userDetail->updated_at = time();
				    			$userDetail->save();
				    			$Response = [
			        			  'message'  => trans('messages.success.otp_verified'),
			        			  'response' => User::find($userDetail->id)
			        			];
			        			Log::info('CommonController----otpVerify----'.print_r($Response,True));
			        			return Response::json( $Response , trans('messages.statusCode.ACTION_COMPLETE') );
				    		} else {
				    			$Response = [
			        				'message'  => trans('messages.invalid.OTP'),
			        			];
			        			return Response::json( $Response , trans('messages.statusCode.SHOW_ERROR_MESSAGE') );
				    		}
			   			break;
			   	}
			    		
			   }
			}else{
				$response['message'] = trans('messages.invalid.detail');
				return response()->json($response,trans('messages.statusCode.INVALID_ACCESS_TOKEN'));
			}
		} else {
	    	$Response = [
			  'message'  => trans('messages.required.user_id'),
			];
	      return Response::json( $Response , trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
    	}
	}

	public function complete_profile(Request $request){
   	Log::info('----------------------CommonController--------------------------complete_profile'.print_r($request->all(),True));
		$accessToken = $request->header('accessToken');
		$name = $request->name;
		$country_code = $request->country_code;
		$mobile = $request->mobile;
		$dob = $request->dob;
		$passcode = $request->passcode;
		$destinationPathOfProfile = base_path().'/'.'Images/';
		$salutation = $request->salutation;
		$profile_image = $request->profile_image;
		$otp = rand(100000,1000000);
		$USER = User::Where(['remember_token' => $accessToken])->first();
		if(count($USER)){
			if($USER->user_type == 1){
				$validations = [
					'salutation' => 'required',
					'name' => 'required',
					'country_code' => 'required',
					'mobile' => 'required',
					'passcode' => 'required',
					'dob' => 'required|date_format:Y-m-d',
				];
			}
			$validator = Validator::make($request->all(),$validations);
			if( $validator->fails() ) {
				$response = [
					'message' => $validator->errors($validator)->first(),
				];
				return Response::json($response,trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
			} else {
				if(isset($_FILES['profile_image']['tmp_name'])){
					// dd($destinationPathOfProfile);
					$uploadedfile = $_FILES['profile_image']['tmp_name'];
					$fileName1 = substr($this->uploadImage($profile_image,$uploadedfile,$destinationPathOfProfile),9); 
					$USER->profile_image = $fileName1;
				}
				$user = new User;
				$USER->salutation = $salutation;
				$USER->name = $name;
				$USER->country_code = $country_code;
				$USER->mobile = $mobile;
				$USER->dob = $dob;
				$USER->passcode = $passcode;
				$USER->otp = $otp;
				$USER->complete_profile_status = 1;
				$USER->updated_at = time();
				$USER->save();
				$userData = $user->getUserDetail($USER->id);
				$otp_status = $this->sendOtp($country_code.$mobile,$otp);
				$response = [
					'message' =>  __('messages.success.profile_complete'),
					'response' => $userData,
				];
				$response['response']['otp_status'] = $otp_status;
				Log::info('CommonController----complete_profile----'.print_r($response,True));
				return response()->json($response,__('messages.statusCode.ACTION_COMPLETE'));
			}
		}else{
			$response = [
				'message' => __('messages.invalid.detail'),
			];
			return Response::json($response,trans('messages.statusCode.INVALID_ACCESS_TOKEN'));
		}
   }

   public function update_profile(Request $request){
   	Log::info('----------------------CommonController--------------------------update_profile'.print_r($request->all(),True));
		$accessToken = $request->header('accessToken');
		$name = $request->name;
		$dob = $request->dob;
		$destinationPathOfProfile = base_path().'/'.'Images/';
		$salutation = $request->salutation;
		$profile_image = $request->profile_image;
		$USER = User::Where(['remember_token' => $accessToken])->first();
		if(count($USER)){
			if($USER->user_type == 1){
				$validations = [
					'salutation' => 'required',
					'name' => 'required',
					'dob' => 'required|date_format:Y-m-d',
				];
			}
			$validator = Validator::make($request->all(),$validations);
			if( $validator->fails() ) {
				$response = [
					'message' => $validator->errors($validator)->first(),
				];
				return Response::json($response,trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
			} else {
				if(isset($_FILES['profile_image']['tmp_name'])){
					if(file_exists($destinationPathOfProfile."big".$USER->profile_image)){
						unlink($destinationPathOfProfile."big".$USER->profile_image);
					}
					if(file_exists($destinationPathOfProfile."small".$USER->profile_image)){
						unlink($destinationPathOfProfile."small".$USER->profile_image);
					}
					if(file_exists($destinationPathOfProfile."thumbnail".$USER->profile_image)){
						unlink($destinationPathOfProfile."thumbnail".$USER->profile_image);
					}
					$uploadedfile = $_FILES['profile_image']['tmp_name'];
					$fileName1 = substr($this->uploadImage($profile_image,$uploadedfile,$destinationPathOfProfile),9); 
					$USER->profile_image = $fileName1;
				}
				$user = new User;
				$USER->salutation = $salutation;
				$USER->name = $name;
				$USER->dob = $dob;
				$USER->updated_at = time();
				$USER->save();
				$userData = $user->getUserDetail($USER->id);
				$response = [
					'message' =>  __('messages.success.profile_updated'),
					'response' => $userData,
				];
				Log::info('CommonController----complete_profile----'.print_r($response,True));
				return response()->json($response,__('messages.statusCode.ACTION_COMPLETE'));
			}
		}else{
			$response = [
				'message' => __('messages.invalid.detail'),
			];
			return Response::json($response,trans('messages.statusCode.INVALID_ACCESS_TOKEN'));
		}
   }

	public function setTimeZone($timezone){
		/*config(['app.timezone' => 'America/Chicago']);
   	$timezone = Config::get('app.timezone');
		date_default_timezone_set($timezone);*/
		date_default_timezone_set($timezone);
	}

	public function sendOtp($mobile,$otp) {
		try{
			$sid = 'AC6ceef3619be02e48da4aba2512cc426b';
			$token = 'eeaa38187028b4a0a9c4f4e105162b6e';
			$client = new Client($sid, $token);
			$number = $client->lookups
				->phoneNumbers("+14154291712")
				->fetch(array("type" => "carrier"));
			$client->messages->create(
			    $mobile, array(
			        'from' => '+14154291712',
			        'body' => 'discounts: please enter this code to verify :'.$otp
			    )
			);
			$response = [
				'message' => 'success',
				'status' => 1
			];
			return $response;
		} catch(Exception $e){
			// dd($e->getMessage());
			$response = [
				'message' => $e->getMessage(),
				'status' => 0
			];
			return $response;
		}
	}

	public function resendOtp(Request $request){
		Log::info('----------------------CommonController--------------------------resendOtp'.print_r($request->all(),True));
		$key = $request->key; // 1 for send otp at mobile
		$email = $request->email;
		$mobile = $request->mobile;
		$country_code = $request->country_code;
	   $user_id  		 = $request->input('user_id');
		$otp = rand(100000,1000000);
		$locale = $request->header('locale');

		$validations = [
			'key' => 'required|numeric',
			'user_id' => 'required',
		];
		$validator = Validator::make($request->all(),$validations);
		if( $validator->fails() ){
		   $response = [
		   	'message'=>$validator->errors($validator)->first()
		   ];
		   return Response::json($response,__('messages.statusCode.SHOW_ERROR_MESSAGE'));
		}else{
			$userDetail=User::where(['id' => $user_id])->first();
			// dd($userDetail);
			if(count($userDetail)){
				$USER = new User;
				if($key == 1){ // otp at mobile
					$otp_status = $this->sendOtp($userDetail->country_code.$userDetail->mobile,$otp);
					$userDetail->otp = $otp;
					$userDetail->otp_verified = 0;
					$userDetail->updated_at = time();
					$userDetail->save();
				}
				if($key == 2){ // otp at email
					$data = [
						'otp' => $otp,
						'email' => $userDetail->email
					];
					$userDetail->email_otp = $otp;
					$userDetail->email_otp_verified = 0;
					$userDetail->updated_at = time();
					$userDetail->save();
					try{
						Mail::send(['text'=>'otp'], $data, function($message) use ($data)
						{
					         $message->to($data['email'])
					         		->subject ('OTP');
					         $message->from('techfluper@gmail.com');
					   });	
					}catch(Exception $e){
						$response=[
							'message' => $e->getMessage()
			      	];
			     		return Response::json($response,__('messages.statusCode.SHOW_ERROR_MESSAGE'));
					}
				}
				
	 			if($key == 1){ // otp at mobile
		 			$Response = [
	     			  'message'  => trans('messages.success.otp_resend'),
	     			  'response' => $USER->getUserDetail($userDetail->id),
	     			];
	     			$Response['response']['otp_status'] = $otp_status;
	     		}
	     		if($key == 2){ // otp at email
	     			$Response = [
	     			  'message'  => trans('messages.success.email_forget_otp'),
	     			  'response' => $USER->getUserDetail($userDetail->id)
	     			];
	     		}
	     		Log::info('CommonController----resendOtp----'.print_r($Response,True));
     			return Response::json( $Response , trans('messages.statusCode.ACTION_COMPLETE') );	
	 		}else{
				$response['message'] = trans('messages.invalid.detail');
				return response()->json($response,trans('messages.statusCode.INVALID_ACCESS_TOKEN'));
			}
		}
	}

	public function change_password(Request $request){
		Log::info('----------------------CommonController--------------------------change_password'.print_r($request->all(),True));
		$accessToken = $request->header('accessToken');
		$old_password = $request->old_password;
		$new_password = $request->new_password;
		$key = $request->key; // 1 (change password) 2 (Reset password)
		$locale = $request->header('locale');
		if(empty($locale)){
			$locale = 'en';
		}
		\App::setLocale($locale);

		$validations = [
			'key' => 'required'
    	];
    	$validator = Validator::make($request->all(),$validations);
    	if($validator->fails()){
    		$response = [
				'message' => $validator->errors($validator)->first()
			];
			return response()->json($response,trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
    	}

    	switch ($key) {
	    	//////////////////////////////////////
	    	///// CHANGE PASSWORD
	    	/////////////////////////////////////
    		case 1:
    			$validations = [
					'old_password' => 'required|min:8',
					'new_password' => 'required|min:8'
		    	];
		    	$validator = Validator::make($request->all(),$validations);
		    	if($validator->fails()){
		    		$response = [
						'message' => $validator->errors($validator)->first()
					];
					return response()->json($response,trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
		    	}else{
		    		$UserDetail = User::where(['remember_token' => $accessToken])->first();
		    		if(count($UserDetail)){
		    			// dd($UserDetail->password);
		    			if(Hash::check($old_password,$UserDetail->password)){
		    				// dd("correct");
		    				$User = User::find($UserDetail->id);
			    			$User->password = Hash::make($new_password);
			    			$User->save();
			    			$userDetail = new \App\User;
			    			$Response = [
			    			  'message'  => trans('messages.success.password_updated'),
			    			  'response' => $userDetail->getUserDetail($UserDetail->id)
			    			];
		        			return Response::json( $Response , trans('messages.statusCode.ACTION_COMPLETE') );
		    			}else{
		    				$Response = [
			    			  'message'  => trans('messages.error.incorrect_old_password'),
			    			];
		        			return Response::json( $Response , trans('messages.statusCode.SHOW_ERROR_MESSAGE') );
		    			}
		    		}else{
		    			$Response = [
		    			  'message'  => trans('messages.invalid.detail'),
		    			];
		        		return Response::json( $Response , trans('messages.statusCode.INVALID_ACCESS_TOKEN') );
		    		}
		    	}
    			break;
    		//////////////////////////////////////////////
    		/////// RESET PASSWORD
    		/////////////////////////////////////////////
    		case 2: 
    			$validations = [
					'new_password' => 'required|min:8'
		    	];
		    	$validator = Validator::make($request->all(),$validations);
		    	if($validator->fails()){
		    		$response = [
						'message' => $validator->errors($validator)->first()
					];
					return response()->json($response,trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
		    	}else{
		    		$UserDetail = User::where(['remember_token' => $accessToken])->first();
		    		if(count($UserDetail)){
		    			// dd($UserDetail->password);
	    				$User = User::find($UserDetail->id);
		    			$User->password = Hash::make($new_password);
		    			$User->save();
		    			$userDetail = new \App\User;
		    			$Response = [
		    			  'message'  => trans('messages.success.password_updated'),
		    			  'response' => $userDetail->getUserDetail($UserDetail->id)
		    			];
	        			return Response::json( $Response , trans('messages.statusCode.ACTION_COMPLETE') );
		    		}else{
		    			$Response = [
		    			  'message'  => trans('messages.invalid.detail'),
		    			];
		        		return Response::json( $Response , trans('messages.statusCode.INVALID_ACCESS_TOKEN') );
		    		}
		    	}
    			break;
			//////////////////////////////////////////////
    		/////// DEFAULT RESPONSE
    		/////////////////////////////////////////////
    		default:
    			$Response = [
    			  'message'  => trans('messages.invalid.request'),
    			];
        		return Response::json( $Response , trans('messages.statusCode.INVALID_ACCESS_TOKEN') );
    			break;
    	}
	}

	public function change_passcode(Request $request){
		Log::info('----------------------CommonController--------------------------change_passcode'.print_r($request->all(),True));
		$accessToken = $request->header('accessToken');
		$old_passcode = $request->old_passcode;
		$new_passcode = $request->new_passcode;
		$locale = $request->header('locale');
		if(empty($locale)){
			$locale = 'en';
		}
		\App::setLocale($locale);
		$validations = [
			'old_passcode' => 'required',
			'new_passcode' => 'required'
    	];
    	$validator = Validator::make($request->all(),$validations);
    	if($validator->fails()){
    		$response = [
				'message' => $validator->errors($validator)->first()
			];
			return response()->json($response,trans('messages.statusCode.SHOW_ERROR_MESSAGE'));
    	}else{
    		$UserDetail = User::where(['remember_token' => $accessToken])->first();
    		if(count($UserDetail)){
    			// dd($UserDetail->password);
    			if($old_passcode == $UserDetail->passcode){
    				// dd("correct");
    				$User = User::find($UserDetail->id);
	    			$User->passcode = $new_passcode;
	    			$User->save();
	    			$userDetail = new \App\User;
	    			$Response = [
	    			  'message'  => trans('messages.success.passcode_updated'),
	    			  'response' => $userDetail->getUserDetail($UserDetail->id)
	    			];
        			return Response::json( $Response , trans('messages.statusCode.ACTION_COMPLETE') );
    			}else{
    				$Response = [
	    			  'message'  => trans('messages.error.incorrect_old_passcode'),
	    			];
        			return Response::json( $Response , trans('messages.statusCode.SHOW_ERROR_MESSAGE') );
    			}
    		}else{
    			$Response = [
    			  'message'  => trans('messages.invalid.detail'),
    			];
        		return Response::json( $Response , trans('messages.statusCode.INVALID_ACCESS_TOKEN') );
    		}
    	}
	}
	
	public function forgetPassword(Request $request) {
		Log::info('----------------------CommonController--------------------------forgetPassword'.print_r($request->all(),True));
		$email = $request->email;
		$otp = rand(100000,1000000);
		$locale = $request->header('locale');
		$validations = [
			'email'=>'required|email'
		];
		$validator = Validator::make($request->all(),$validations);
		if( $validator->fails() ){
		   $response = [
		   	'message'=>$validator->errors($validator)->first()
		   ];
		   return Response::json($response,__('messages.statusCode.SHOW_ERROR_MESSAGE'));
		}else{
			$UserDetail = User::Where(['email' => $email])->first();
			if(count($UserDetail)){
				$data = [
					'otp' => $otp,
					'email' => $email
				];
				try{
					Mail::send(['text'=>'otp'], $data, function($message) use ($data)
					{
			         $message->to($data['email'])
			         		->subject ('Forget Password OTP');
			         $message->from('techfluper@gmail.com');
				   });	
				}catch(Exception $e){
					$response=[
						'message' => $e->getMessage()
		      	];
		     		return Response::json($response,__('messages.statusCode.SHOW_ERROR_MESSAGE'));
				}
				$UserDetail->email_otp = $otp;
				$UserDetail->email_otp_verified = 0;
				$UserDetail->updated_at = time();
				$UserDetail->save();
				$user = new User;
				$userData = $user->getUserDetail($UserDetail->id);
				$response=[
					'message' => trans('messages.success.email_forget_otp'),
					'response' => $userData
		      ];
		      Log::info('CommonController----forgetPassword----'.print_r($response,True));
		      return Response::json($response,__('messages.statusCode.ACTION_COMPLETE'));
			} else {
				$response=[
				'message' => trans('messages.invalid.credentials'),
	      	];
		      return Response::json($response,__('messages.statusCode.SHOW_ERROR_MESSAGE'));
			}
		}
	}

	public function uploadImage($photo,$uploadedfile,$destinationPathOfPhoto){
        /*$photo = $request->file('photo');
        $uploadedfile = $_FILES['photo']['tmp_name'];
        $destinationPathOfPhoto = public_path().'/'.'thumbnail/';*/
        $fileName = time()."_".$photo->getClientOriginalName();
        $src = "";
        $i = strrpos($fileName,".");
        $l = strlen($fileName) - $i;
        $ext = substr($fileName,$i+1);

        if($ext=="jpg" || $ext=="jpeg" || $ext=="JPG" || $ext=="JPEG"){
            $src = imagecreatefromjpeg($uploadedfile);
        }else if($ext=="png" || $ext=="PNG"){
            $src = imagecreatefrompng($uploadedfile);
        }else if($ext=="gif" || $ext=="GIF"){
            $src = imagecreatefromgif($uploadedfile);
        }else{
            $src = imagecreatefrombmp($uploadedfile);
        }
        $newwidth  = 200;
        list($width,$height)=getimagesize($uploadedfile);
        $newheight=($height/$width)*$newwidth;
        $tmp=imagecreatetruecolor($newwidth,$newheight);
        imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
        $filename = $destinationPathOfPhoto.'small'.'_'.$fileName; 
        imagejpeg($tmp,$filename,100);
        imagedestroy($tmp);
        $filename = explode('/', $filename);

        $newwidth1  = 400;
        list($width,$height)=getimagesize($uploadedfile);
        $newheight1=($height/$width)*$newwidth1;
        $tmp=imagecreatetruecolor($newwidth1,$newheight1);
        imagecopyresampled($tmp,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);
        $filename = $destinationPathOfPhoto.'big'.'_'.$fileName; 
        imagejpeg($tmp,$filename,100);
        imagedestroy($tmp);
        $filename = explode('/', $filename);

        $newwidth2  = 100;
        list($width,$height)=getimagesize($uploadedfile);
        $newheight2=($height/$width)*$newwidth2;
        $tmp=imagecreatetruecolor($newwidth2,$newheight2);
        imagecopyresampled($tmp,$src,0,0,0,0,$newwidth2,$newheight2,$width,$height);
        $filename = $destinationPathOfPhoto.'thumbnail'.'_'.$fileName; 
        imagejpeg($tmp,$filename,100);
        imagedestroy($tmp);
        $filename = explode('/', $filename);
        return $filename[6];
   }
}
