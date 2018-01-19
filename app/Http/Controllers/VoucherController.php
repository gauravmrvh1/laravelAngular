<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\User;
use \App\Models\Voucher;
use Session;
use DB;
use \Carbon\Carbon;

class VoucherController extends Controller
{

   public function index(Request $request){
   	if($request->method()=='GET'){
   		if(Session::get('mai_store_loggedin') == true){
   			return view('UserPanel/createVoucher');
   		}else{
				return redirect('UserPanel/login');
			}
   	}

   	if($request->method() == 'POST'){
   		$store_id = session('mai_user_id');
   		$voucher_code = $request->voucher_code;
   		$voucher_validity = $request->voucher_validity;
   		$voucher_point = $request->voucher_point;
   		$voucher_type = $request->voucher_type;
   		$voucher_description = $request->voucher_description;
   		$Voucher_detail = Voucher::where(['store_id' => $store_id , 'code' => $voucher_code])->first();
   		// dd($Voucher_detail);
   		if(empty($Voucher_detail)){
   			$Voucher_Detail = new Voucher;
	   		$Voucher_Detail->store_id = $store_id;
	   		$Voucher_Detail->code = $voucher_code;
	   		$Voucher_Detail->description = $voucher_description;
	   		$Voucher_Detail->point = $voucher_point;
	   		$Voucher_Detail->validity = $voucher_validity;
	   		$Voucher_Detail->type = $voucher_type;
	   		$Voucher_Detail->save();
	   		return redirect()->back()->with('voucher_created','Voucher Created Successfully. Please Wait for approval from admin');
	   	}else{
	   		return redirect()->back()->withInput()->with('voucher_already_exist','Voucher Code already exist.');
	   	}
   	}
   }

   public function list(Request $request){
   	if($request->method()=='GET'){
   		if(Session::get('mai_store_loggedin') == true){
   			$voucher_list = Voucher::all();
   			// dd($voucher_list);
   			return view('UserPanel/voucherList',compact('voucher_list'));
   		}else{
				return redirect('UserPanel/login');
			}
   	}
   }


   public function edit(Request $request){
   	if($request->method()=='GET'){
   		if(Session::get('mai_store_loggedin') == true){
   			$voucher = Voucher::find($request->voucher_id);
   			// dd($voucher->validity);
   			return view('UserPanel/editVoucher',compact('voucher'));
   		}else{
				return redirect('UserPanel/login');
			}
   	}


   	if($request->method() == 'POST'){
   		$voucher_id = $request->voucher_id;
   		$store_id = session('mai_user_id');
   		$voucher_code = $request->voucher_code;
   		$voucher_validity = $request->voucher_validity;
   		$voucher_point = $request->voucher_point;
   		$voucher_type = $request->voucher_type;
   		$voucher_description = $request->voucher_description;
   		// return date('Y-m-d',strtotime($voucher_validity));
   		$Voucher_detail = Voucher::where(['id' => $voucher_id])->first();
   		// dd($Voucher_detail);
   		if($Voucher_detail){
   			$Voucher_exist = Voucher::where(['store_id' => $store_id , 'code' => $voucher_code])->where('id','<>',$voucher_id)->first();
   			if(!$Voucher_exist){
		   		$Voucher_detail->store_id = $store_id;
		   		$Voucher_detail->code = $voucher_code;
		   		$Voucher_detail->description = $voucher_description;
		   		$Voucher_detail->point = $voucher_point;
		   		$Voucher_detail->validity = date('Y-m-d',strtotime($voucher_validity));
		   		$Voucher_detail->type = $voucher_type;
               $Voucher_detail->status_by_admin = 0; // Again need to approved by admin
		   		$Voucher_detail->status = 0; // Again need to approved by admin
		   		$Voucher_detail->save();
		   		return redirect()->back()->with('voucher_updated','Voucher Updated Successfully. Please Wait for approval from admin');
		   	}else{
		   		return redirect()->back()->withInput()->with('already_exist','Voucher already exist.');
		   	}
	   	}else{
	   		return redirect()->back()->withInput()->with('invalid_request','Invalid Request.');
	   	}
   	}
   }

   public function delete(Request $request){
   	if($request->method()=='GET'){
   		if(Session::get('mai_store_loggedin') == true){
   			$voucher_id = $request->segment(3);
   			Voucher::where(['id' => $voucher_id])->delete();
   			return redirect()->back()->with('voucher_deleted','Voucher deleted Successfully.');
   		}else{
				return redirect('UserPanel/login');
			}
   	}
   }

   
}
