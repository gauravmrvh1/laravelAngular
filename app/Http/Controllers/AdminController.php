<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;
use Mail;
use Log;
use Response;
use App\User;
use App\Models\Admin;
use App\Models\Voucher;
use Session;
use \Carbon\Carbon;

class AdminController extends Controller
{
	
	public function login( Request $request ) {
		$email         = $request->email;
		$password      = $request->password;
		$adminDetail = Admin::getAdminDetail( null , $email , $password);
		if( count( $adminDetail ) ) {
			$photo = null;
			if($adminDetail->photo){
				$photo = url('').'/'.'adminImages/'.$adminDetail->photo;
			}
			$result = [
				'id' => $adminDetail->id,
				'name' => $adminDetail->name,
				'email' => $adminDetail->email,
				'photo' => $photo,
				'mobile' => $adminDetail->mobile,
				'location' => $adminDetail->location,
				'aboutMe' => $adminDetail->aboutMe,
				'address' => $adminDetail->address,
				'password' => $adminDetail->password,
				'type' => $adminDetail->type,
				'status' => $adminDetail->status,
			];
			$response = [
				'message' => 'success',
				'response' => $result,
			];
			return response()->json($response, 200);
		}else{
 			$response = [
				'message' =>  'invalid'
			];
			return response()->json($response,400);
 		}
	}

	public function dashboard() {
		$AdminloggedIn = Session::get( 'AdminloggedIn' );
		$adminId = Session::get('AdminId');
		$adminDetail = Admin::getAdminDetail( $adminId ,null , null);
		// dd($AdminloggedIn);
		if( !empty( $AdminloggedIn ) ) {
			return view('Admin/index' , compact('adminDetail'));
		} else {
			return redirect('Admin/login');
		}
	}

	public function merchant_list( Request $request ) {
		$merchant_list = User::where(['user_type' => 2 ,'complete_profile_status' => 1])->get(); // merchant with blocked user havid status 0
			// return $merchant_list;
		$response = [
			'message' => 'Merchant list',
			'response' => $merchant_list
		];	
		return response()->json($response,200);
	}

	public function user_list( Request $request ) {
		$user_list = User::where(['user_type' => 1])->get(); // merchant with blocked user havid status 0
		$response = [
			'message' => 'user list',
			'response' => $user_list
		];	
		return response()->json($response,200);
	}

	public function profile( Request $request ) {
		$AdminloggedIn = Session::get( 'AdminloggedIn' );
		$adminId = Session::get('AdminId');
		if( $request->method() == 'GET' ) {
			if( !empty( $AdminloggedIn ) ) {
				$adminDetail = Admin::getAdminDetail( $adminId ,null , null);
				return view('Admin/profile' ,compact('adminDetail'));
			}
		} else {
			return view('Admin/login');
		}
	}

	public function editProfile( Request $request ) {
		$address = $request->address;
		$about = $request->about;
		$email = $request->email;
		$phone = $request->phone;
		$location = $request->location;
		$photo = $request->file('photo');
		$adminId = $request->admin_id;
		$destinationPathOfProfile = public_path().'/'.'adminImages/';

		$AdminDetail = [ 
			'mobile'   => $phone,
			'location' => $location,
			'aboutMe'  => $about,
			'address'  => $address,
		];

		if( !empty($photo) ) {
			$AdminDetail = Admin::getAdminDetail( $adminId , null ,null );
			if( !empty($AdminDetail->photo) &&  file_exists(public_path().'/'.'adminImages/'.$AdminDetail->photo) ){
				unlink(public_path().'/'.'adminImages/'.$AdminDetail->photo);
			}
			$fileName = time()."_".$photo->getClientOriginalName();
			$photo->move( $destinationPathOfProfile , $fileName );
			$AdminDetail = [ 
				'mobile'    => $phone,
				'location' => $location,
				'aboutMe'  => $about,
				'address'  => $address,
				'photo'    => $fileName
			];
			Admin::updateAdminDetail($AdminDetail,$adminId);
			$adminDetail = Admin::getAdminDetail( $adminId , null ,null );
			$photo = null;
			if($adminDetail->photo){
				$photo = url('').'/'.'adminImages/'.$adminDetail->photo;
			}
			$result = [
				'id' => $adminDetail->id,
				'name' => $adminDetail->name,
				'email' => $adminDetail->email,
				'photo' => $photo,
				'mobile' => $adminDetail->mobile,
				'location' => $adminDetail->location,
				'aboutMe' => $adminDetail->aboutMe,
				'address' => $adminDetail->address,
				'password' => $adminDetail->password,
				'type' => $adminDetail->type,
				'status' => $adminDetail->status,
			];

			$response = [
				'message' => 'Profile updated successfully',
				'response' => $result
			];
			return response()->json($response,200);
		}else{
			Admin::updateAdminDetail($AdminDetail,$adminId);
			$adminDetail = Admin::getAdminDetail( $adminId , null ,null );
			$photo = null;
			if($adminDetail->photo){
				$photo = url('').'/'.'adminImages/'.$adminDetail->photo;
			}
			$result = [
				'id' => $adminDetail->id,
				'name' => $adminDetail->name,
				'email' => $adminDetail->email,
				'photo' => $photo,
				'mobile' => $adminDetail->mobile,
				'location' => $adminDetail->location,
				'aboutMe' => $adminDetail->aboutMe,
				'address' => $adminDetail->address,
				'password' => $adminDetail->password,
				'type' => $adminDetail->type,
				'status' => $adminDetail->status,
			];

			// return $adminDetail;

			$response = [
				'message' => 'Profile updated successfully',
				'response' => $result
			];
			return response()->json($response,200);
		}
	}

	public function voucher_list( Request $request ) {
		$AdminloggedIn = Session::get( 'AdminloggedIn' );
		$adminId = Session::get('AdminId');
		$adminDetail = Admin::getAdminDetail( $adminId ,null , null);
		if( !empty( $AdminloggedIn ) ) {
			$voucherList = Voucher::all(); // merchant with blocked user havid status 0
			$result = [];
			foreach ($voucherList as $key => $value) {
				$value->store_detail;
			}
			// return $voucherList;
			return view('Admin/voucherList',compact('adminDetail','voucherList'));
		} else {
			return redirect('Admin/login');
		}
	}

	// Approve OR Reject Voucher Created By store from admin panel
	public function update_voucher_status( Request $request ) {
		$AdminloggedIn = Session::get( 'AdminloggedIn' );
		$adminId = Session::get('AdminId');
		$adminDetail = Admin::getAdminDetail( $adminId ,null , null);
		$voucher_id = $request->voucher_id;
		$status = $request->status;
		if( !empty( $AdminloggedIn ) ) {
			$voucher = Voucher::find($voucher_id); 
			if($voucher){
				$voucher->status = $status;
				$voucher->save();
				if($status == 1){
					return redirect('/Admin/voucher_list')->with('voucher_approved','Voucher Approved Successfully.');
				}else{
					return redirect('/Admin/voucher_list')->with('voucher_rejected','Voucher Rejected Successfully.');
				}
			}else{
				dd('invalid request');
			}
		} else {
			return redirect('Admin/login');
		}
	}

	// Block or Unblock customer from admin panel
	public function update_user_status( Request $request ) {
		$user_id = $request->userId;
		$status = $request->status;
		$user = User::find($user_id); 
		if($user && $user->user_type == 1){
			$user->status = $status;
			$user->save();
			if($status == 1){
				$response = [
					'message' => 'user Unblock successfully.',
				];
				return response()->json($response,200);
			}else{
				$response = [
					'message' => 'user Blocked successfully.',
				];
				return response()->json($response,200);
			}
			
		}else{
			dd('invalid request');
		}
	}

	// Block or Unblock Merchant from admin panel
	public function update_merchant_status( Request $request ) {
		$AdminloggedIn = Session::get( 'AdminloggedIn' );
		$adminId = Session::get('AdminId');
		$adminDetail = Admin::getAdminDetail( $adminId ,null , null);
		$merchant_id = $request->merchant_id;
		$status = $request->status;
		if( !empty( $AdminloggedIn ) ) {
			$user = User::find($merchant_id); 
			if($user && $user->user_type == 2){
				$user->status = $status;
				$user->save();
				if($status == 1){
					return redirect('/Admin/merchant_list')->with('merchant_unblocked','Merchant Unblocked Successfully.');
				}else{
					return redirect('/Admin/merchant_list')->with('merchant_blocked','Merchant Blocked Successfully.');
				}
			}else{
				dd('invalid request');
			}
		} else {
			return redirect('Admin/login');
		}
	}

	public function changePassword( Request $request ) {
		$old_password = $request->old_password;
		$new_password = $request->new_password;
		$admin_id = $request->admin_id;

		$adminDetail = Admin::getAdminDetail( $admin_id , null , null);

		if( count($adminDetail) ){
			$AdminDetail = [ 'password' => $new_password];
			$up = DB::table('admin')
				->where('id',$admin_id)
				->update($AdminDetail);
			$response = [
				'message' => 'Password updated successfully.',
				'response' => Admin::getAdminDetail( $admin_id , null , null)
			];				
			return response()->json($response,200);
			
		}
	}

	public function logout( Request $request ) {
		Session::forget('AdminloggedIn');
		return redirect('Admin/login');
	}

	public function createSubAdmin(Request $request){
		$navigationList = DB::table('navigations')->select('id','name')->get();
		$AdminloggedIn = Session::get( 'AdminloggedIn' );
		$adminId = Session::get('AdminId');
		if( !empty( $AdminloggedIn ) ) {
			if($request->method() == 'GET'){
				$adminDetail = Admin::getAdminDetail( $adminId ,null , null);
				return view('Admin/createSubadmin',compact('adminDetail','navigationList','adminList'));
			}

			if($request->method() == 'POST'){
				$validations = [
					'email'=> 'required|email|unique:admin',
					'password'=> 'required|min:8',
				];
				$messages = [
				    'email.required' => 'please enter email address!',
				    'password.required' => 'please enter password!'
				];
				$validator = Validator::make($request->all() , $validations, $messages );
				if( $validator->fails() ) {
					return redirect('Admin/createSubAdmin')->withErrors( $validator )->withInput();
				} else {
					$SubAdminDetail = [ 
						'email'    => $request->email,
						'password'  => $request->password,
						'type' => 2
					];
					$insertId = DB::table('admin')->insertGetId($SubAdminDetail);
					if($insertId){
						DB::table('adminPermissions')
							->insert(['adminId'=>$insertId,'permissions'=>6]);
						session()->flash('subAdminCreated','Subadmin created successfully !');
						return redirect('Admin/SubAdminList');
					}else{
						Log::info('createSubAdmin()  --------> Error in Subadmin creation');
					}
					
				}
			}
		}else{
			return view('Admin/login');
		}
	}

	public function addInterest( Request $request ) {
		$navigationList = DB::table('navigations')->select('id','name')->get();
		$AdminloggedIn = Session::get( 'AdminloggedIn' );
		$adminId = Session::get('AdminId');
		$adminDetail = Admin::getAdminDetail( $adminId ,null , null);
		$interest = $request->interest;

		if( $request->method() == 'GET' ) {
			if( empty( $AdminloggedIn ) ) {
				return view('Admin/login');
			} else {
				$interestList = Admin::getInterestList();
				return view('Admin/addInterest' ,compact('adminDetail','interestList','navigationList'));
			}
		} else if( $request->method() == 'POST' ) {
			$validations = [
				'interest' => 'required',
			];
			$validator = Validator::make($request->all(),$validations);
			if( $validator->fails() ) {
				return redirect('Admin/addInterest')  
					   ->withErrors( $validator )
					   ->withInput();
			} else {
				$check = Admin::checkInterestExsistance($interest , null );
				if( !empty($check) ) {
					return redirect('Admin/addInterest')  
					   ->with( 'alreadyExistInterest' , 'interest already exist' );
				} else {
					$data = ['name' => $interest];
					$in = Admin::insertInterest( $data );
					if( $in ) {
						Session()->flash('InterestInserted' , 'interest added successfully.');
						$interestList = Admin::getInterestList();
						// return view('Admin/addInterest' ,compact('adminDetail','interestList','navigationList'));

						return redirect('Admin/addInterest')  
								->with( 'InterestInserted' , 'interest added successfully.' );
					} else {
						Session()->flash('InterestInsertErr' , 'error in insert');
						$interestList = Admin::getInterestList();
						// return view('Admin/addInterest' ,compact('adminDetail','interestList','navigationList'));
						return redirect('Admin/addInterest')  
								->with( 'InterestInsertErr' , 'error in insert' )
								->withInput();
					}
				}
			}
		}
	}

	public function editInterest( Request $request ) {
		$navigationList = DB::table('navigations')->select('id','name')->get();
		$interest = $request->editInterest;
		$interestId = $request->interestId;

		$exist    = Admin::checkInterestExsistance( $interest , null );
		$validations = [
			'editInterest' => 'required',
	    ];
		$validator = Validator::make($request->all(),$validations);
		if( $validator->fails() ) {
			return redirect('Admin/addInterest')->withErrors( $validator )->withInput();
		} else {
			if( count($exist) ) {
				return redirect('Admin/addInterest')
						->with( 'alreadyExistInterestModel' , 'interest already exist' );
			} else {
				$data = [ 'name' => $interest];
				$up = Admin::updateInterest( $data , $interestId );
				if( $up ) {
					return redirect('Admin/addInterest')
						->with( 'editedInterest' , 'interest edited successfully.' );
				} else {
					return redirect('Admin/addInterest')
						->with( 'editedInterestErr' , 'error.' );
				}
			}
		}
	}

	public function checkInterestExsistance( Request $request ) {
		$navigationList = DB::table('navigations')->select('id','name')->get();
		$interest = $_POST[ 'interest' ];
		$interestId = $_POST[ 'interestId' ];
		$exist    = Admin::checkInterestExsistance( $interest , null );
		return count($exist);
	}

	public function checkSubInterestExsistance( Request $request ) {
		$navigationList = DB::table('navigations')->select('id','name')->get();
		$Subinterest = $_POST[ 'Subinterest' ];
		$SubinterestId  = $_POST[ 'SubinterestId' ];
		$exist    = Admin::checkSubInterestExsistance( $Subinterest , null );
		return count($exist);
	}

	public function deleteInterest( Request $request ) {
		$navigationList = DB::table('navigations')->select('id','name')->get();
		$interestId = $request->interestId;
		$dataExistUnderInterest = Admin::checkSubinterestUnderInterest( $interestId );
		if( $dataExistUnderInterest ) {
			return "exist";
		} 
		
		if( !$dataExistUnderInterest ) {
			$del = Admin::deleteInterest( $interestId );   
			if( $del ) {
				return "deleted";
			}
		}
	}

	public function addSubInterest( Request $request ) {
		$navigationList = DB::table('navigations')->select('id','name')->get();
		$AdminloggedIn = Session::get( 'AdminloggedIn' );
		$adminId       = Session::get('AdminId');
		$interestId    = $request->segment(3);
		$SubInterest   = $request->SubInterest;
		if( !empty( $AdminloggedIn ) ) {
			if( $request->method() == 'GET' ) {
				if( !empty( $AdminloggedIn ) ) {
					$getInterestById = Admin::checkInterestExsistance( null , $interestId );
					$adminDetail = Admin::getAdminDetail( $adminId ,null , null);
					$SubInterestUnderIntrestId = Admin::getSubInterestUnderInterestId( $interestId );
					return view('Admin/addSubInterest' ,compact('adminDetail' , 'getInterestById' , 'SubInterestUnderIntrestId' ,'navigationList'));
				}
			}elseif( $request->method() == 'POST' ) {
				$validations = [
								 'SubInterest' => 'required',
							   ];
				$validator = Validator::make($request->all(),$validations);
				if( $validator->fails() ) {
					// return redirect('Admin/addSubInterest'.'/'.$interestId,compact('navigationList'))  
					return redirect('Admin/addSubInterest'.'/'.$interestId)  
						   ->withErrors( $validator )
						   ->withInput();
				} else { 
					$data = [ 
						'interestId'      => $interestId,
						'subInterestName' => $SubInterest,
					];
					$existSubInterestUnderInterestId = Admin::checkSubinterestUnderInterestId( $interestId , $SubInterest );
					if( !count( $existSubInterestUnderInterestId ) ) {
						Admin::insertSubInterest( $data );
					
						$getInterestById = Admin::checkInterestExsistance( null , $interestId );
						$adminDetail = Admin::getAdminDetail( $adminId ,null , null);
						$SubInterestUnderIntrestId = Admin::getSubInterestUnderInterestId( $interestId );
						// return view('Admin/addSubInterest' ,compact('adminDetail' , 'getInterestById' , 'SubInterestUnderIntrestId' ,'navigationList'));
						return redirect('Admin/addSubInterest'.'/'.$interestId)  
						   ->with( 'subInterestAdded' , 'sub interest added successfully.');
					} else {
						return redirect('Admin/addSubInterest'.'/'.$interestId)  
						   ->with( 'subInterestAlreadyUnderInterestId' , 'sub interest already exist.');
					}
				}  
			} else {
				return view('Admin/login',compact('navigationList'));
			}
		}else {
			return redirect('Admin/login');
		}
	}

	public function editSubInterest( Request $request ) {
		$navigationList = DB::table('navigations')->select('id','name')->get();
		$InterestId = $request->InterestId;
		$SubInterest = $request->SubInterest;
		$SubInterestId = $request->SubInterestId;
		$AdminloggedIn = Session::get( 'AdminloggedIn' );
		$data = [ 'subInterestName' => $SubInterest];
		$up = Admin::updateSubInterest( $data , $SubInterestId );
		if( !empty( $AdminloggedIn ) ) {
			if( $up ) {
				return redirect('Admin/addSubInterest'.'/'.$InterestId)
					->with( 'editedSubInterest' , 'sub interest edited successfully.' );
			} else {
				return redirect('Admin/addSubInterest'.'/'.$InterestId)
					->with( 'editedSubInterestErr' , 'error.' );
			}
		}else {
			return redirect('Admin/login');
		}
	}
		
	public function deleteSubInterest( Request $request ) {
		$navigationList = DB::table('navigations')->select('id','name')->get();
		$SubInterestId = $request->SubInterestId;
		$dataExistUnderUserSubInterest = Admin::checkSubinterestUnderUserSubInterest( $SubInterestId );
		
		if( count( $dataExistUnderUserSubInterest ) ) {
			return "exist";
		} 
		
		if( !count( $dataExistUnderUserSubInterest ) ) {
			$del = Admin::deleteSubInterest( $SubInterestId );   
			if( $del ) {
				
				return "deleted";
			}
		}
	}

	///////////////////////////////////////////////
	/////// --------------END---------------------
	///////////////////////////////////////////////

	


	public function BlockedUserList( Request $request ) {
		$navigationList = DB::table('navigations')->select('id','name')->get();
		$AdminloggedIn = Session::get( 'AdminloggedIn' );
		$adminId = Session::get('AdminId');
		$adminDetail = Admin::getAdminDetail( $adminId ,null , null);
		if( !empty( $AdminloggedIn ) ) {
			$userList = User::getBlockedUsersList();
			return view('Admin/userList',compact('adminDetail','userList','navigationList'));
		} else {
			return redirect('Admin/login');
		}
	}


	public function userDetail( Request $request ) {
		// return redirect('Admin/login');
		$navigationList = DB::table('navigations')->select('id','name')->get();
		$AdminloggedIn = Session::get( 'AdminloggedIn' );
		$adminId = Session::get('AdminId');
		$adminDetail = Admin::getAdminDetail( $adminId ,null , null);
		if( !empty( $AdminloggedIn ) && $AdminloggedIn != null) {
			// $userList = User::getUsersList();
			$userList = User::getAllUsersList();
			return view('Admin/userDetail',compact('navigationList','adminDetail','userList'));
		} else {
			return redirect('Admin/login');
		}
	}

	public function get_user_detail(Request $request){
		$UserDetail = User::getUserDetail( $request->userId , $accessToken = null , $country_code = null ,
			$mobile = null , $email = null );
		return $UserDetail;

	}

	public function edit_user_Profile(Request $request){
		$navigationList = DB::table('navigations')->select('id','name')->get();
		$AdminloggedIn = Session::get( 'AdminloggedIn' );
		$adminId = Session::get('AdminId');
		$adminDetail = Admin::getAdminDetail( $adminId ,null , null);
		if( !empty( $AdminloggedIn ) ) {
			if($request->method() == 'GET'){
				$userId = $request->segment(3);
				$userDetail = User::getUserDetail($userId);
				$userList = User::getUsersList();
				$interestList = DB::table('interest')->get();
				// dd($userDetail);
				return view('Admin/editUserDetail',compact('navigationList','adminDetail','userList','userDetail','interestList'));
			}else{
				// dd($request->all());
				$validations = [
					'name' => 'required',
					'email' =>  ['required',Rule::unique('users')->ignore($request->userId, 'id')],
					'dob' => 'required|date_format:Y-m-d',
					'gender' => 'required',
					'Profession' => 'required',
					// 'homeTown' => 'required',
					'relationShipStatus' => 'required',
					'kids' => 'required',
					'sexualOrientation' => 'required',
					'height' => 'required',
					'eyes' => 'required',
					'hair' => 'required',
					'smoking' => 'required',
					'drink' => 'required',
					'language' => 'required',
					'animal' => 'required',
					'aboutMe' => 'required'
				];
				$Validator = Validator::make($request->all(),$validations);
				if($Validator->fails()){
					// dd($Validator->errors($Validator)->first());
					return redirect()->back()->with('error',$Validator->errors($Validator)->first());
				}
				$name = $request->name;
				$dob = $request->dob;
				$email = $request->email;
				$gender = $request->gender;
				$Profession = $request->Profession;
				$homeTown = $request->homeTown;
				$relationShipStatus = $request->relationShipStatus;
				$kids = $request->kids;
				$sexualOrientation = $request->sexualOrientation;
				$height = $request->height;
				$eyes = $request->eyes;
				$hair = $request->hair;
				$smoking = $request->smoking;
				$drink = $request->drink;
				$language = $request->language;
				$animal = $request->animal;
				$aboutMe = $request->aboutMe;
				$destinationPathOfProfile = base_path().'/'.'userImages/';
				$image = $request->file('user_image');
				// dd(count($request->sub_interest));
				if($request->sub_interest){
					DB::table('userSubInterest')->where(['userSubInterest.interestId'=>$request->interest,'userSubInterest.userId'=>$request->userId])->delete();
					foreach ($request->sub_interest as $key => $value) {
						DB::table('userSubInterest')->insert(['interestId'=>$request->interest,'subInterestId'=>$value,'userId'=>$request->userId]);
						// dd($value);
					}
				}
				if($image){
					$image_name = time().'_'.$image->getClientOriginalName();
					$image->move($destinationPathOfProfile,$image_name);
					DB::table('userDetail')
					->where(['userId' => $request->userId])
					->update(['photo'=>$image_name]);
				}
				// dd();
				if($email){
					DB::table('users')
					->where(['id' => $request->userId])
					->update(['email'=>$email]);
				}
				// dd($homeTown);
				if($citiDetail = DB::table('cities')->where(['cityName'=>$homeTown])->first()){
					dd($citiDetail->countriesId);
				}

				/*DB::table('users')
					->where(['id' => $request->userId])
					->update(['country'=>$request->country]);*/

				DB::table('userDetail')
					->where(['userId' => $request->userId])
					->update(['name'=>$name,'dob'=>$dob,'gender'=>$gender,'profession'=>$Profession,'relationShipStatus'=>$relationShipStatus,'kids'=>$kids,'sexualOrientation'=>$sexualOrientation,'height'=>$height,'eyes'=>$eyes,'hair'=>$hair,'smoking'=>$smoking,'drinking'=>$drink,'language'=>$language,'animal'=>$animal,'homeTown'=>$request->homeTown ,'aboutMe' => $aboutMe]);
				return redirect()->back()->with('success','Profile updated successfully.');
			}

		} else {
			return redirect('Admin/login',compact('navigationList'));
		}
	}

	public function get_subinterest_by_interest(Request $request){
		$userId = $request->userId;
		$interestId = $request->interestId;
		// return $request->userId;
		$data = DB::table('interest')
					->join('subInterest','subInterest.interestId','=','interest.id')
					->where(['interest.id'=>$interestId])
					->select('interest.id as interestId','interest.name as interestName','subInterest.id as subInterestId','subInterest.subInterestName as subInterestName')
					->get();
		$result = [];
		foreach ($data as $key => $value) {
			$result []= [
				'interestId' => $value->interestId,
				'interestName' => $value->interestName,
				'subInterestId' => $value->subInterestId,
				'subInterestName' => $value->subInterestName,
				'selected' => DB::table('userSubInterest')->where(['userSubInterest.userId'=>$userId,'userSubInterest.interestId'=>$interestId,'userSubInterest.subInterestId'=>$value->subInterestId])->count()
			];
		}
		return $result;
	}

	public function getCountries(Request $request){
		$userId = $request->userId;
		// dd($userId);
		// dd();
		$countries = DB::table('countries')->get();
		$result = [];
		foreach ($countries as $key => $value) {
			// dd($value);
			$userData = DB::table('users')->where(['id'=>$userId])->select('country')->first();
			if($userData){
				if($userData->country == $value->id){
					$selected = 1;
				}else{
					$selected = 0;
				}
			}
			$result[] = [
				'id' => $value->id,
				'name' => $value->name,
				'dial_code' => $value->dial_code,
				'code' => $value->code,
				'selected' => $selected,
			];
		}
		return $result;
	}

	public function get_cities_under_countries(Request $request){
		$countryId = $request->countryId;
		$userId = $request->userId;
		$result = [];
		$data = DB::table('cities')->where(['countriesId'=>$countryId])->get();
		foreach ($data as $key => $value) {
			// dd($value);
			$userData = DB::table('userDetail')->where(['id'=>$userId])->select('homeTown')->first();
			// dd($userData);
			if($userData){
				if($userData->homeTown == $value->id){
					$selected = 1;
				}else{
					$selected = 0;
				}
			}
			$result[] = [
				'id' => $value->id,
				'countryId' => $value->countriesId,
				'cityName' => $value->cityName,
				'selected' => $selected,
			];
		}
		return $result;
		// return $data;
	}

	public function updateUserStatus( Request $request ) {
		$userId = $request->userId;
		$status = $request->value;;
		$up = User::updateUserStatus( $userId , $status );
		return $up;
	}

	public function changePhotoShowToPublicStatus( Request $request ) {
		$navigationList = DB::table('navigations')->select('id','name')->get();
		$status = $request->status;
		$userId = $request->userId;
		$up = User::changePhotoShowToPublicStatus( $status , $userId );
		return redirect('Admin/userDetail');
	}

	public function TermsCondition() {
		return view('termAndCondition');
	}

	public function PrivacyPolicy() {
		return view('privacyPolicy');
	}

	public function getOnlineByCountryName(Request $request){
		$countryName = $request->countryName;
		$navigationList = DB::table('navigations')->select('id','name')->get();
		$countryId = DB::table('countries')->where('name',$countryName)->pluck('id');
		$countNumberOfUserOnlineInAbouveCountry = DB::table('users')
			->where('country',$countryId)
			->where('online','=',1)
			->count();
		$data =[
			'countryName' => $countryName,
			'onlineUser' => $countNumberOfUserOnlineInAbouveCountry
		];
		return Response::json($data,200);
	}

	public function blockUnblockAdmin(Request $request){
		$AdminId = $request->AdminId;
		$value = $request->value;

		$up = DB::table('admin')->where('admin.id',$AdminId)->update(['status'=>$value]);

		return $up;
	}

	public function getUserDetailById(Request $request){
		$userId = $request->userId;
		$UserDetailById = User::getUserDetail($userId , null , null , null , null);
		return response()->json($UserDetailById,200);
	}

	public function update_user_detail_by_admin(Request $request){
		// dd($request->all());
		$user_id = $request->user_id;	
		$name = $request->username;
		$email = $request->email;
		$profession = $request->profession;
		// dd($email);
		$dob = date('Y-m-d',strtotime($request->dob));
		$gender = $request->gender;
		$validations = [
			'username' => 'required|max:255',
			'email' => ['required',Rule::unique('users')->ignore($user_id, 'id')],
			'dob' => 'required',
			'gender' => 'required',
    	];
    	$validator = Validator::make($request->all(),$validations);
    	if($validator->fails()){
    		return redirect('Admin/userDetail')->withErrors($validator);
    	}else{
    		// dd($user_id);
    		DB::table('users')
    			->where(['users.id' => $user_id])
    			->update(['users.email' => $email]);

    		DB::table('userDetail')
    			->where(['userDetail.userId' => $user_id])
				->update([
						'userDetail.name' => $name,
						'userDetail.dob' => $dob,
						'userDetail.profession' => $profession,
						'userDetail.gender' => $gender]);
    		return redirect('Admin/userDetail');
    	}
	}
}
