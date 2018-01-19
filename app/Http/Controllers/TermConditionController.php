<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\User;
use \App\Models\Voucher;
use Session;
use DB;

class TermConditionController extends Controller
{
    public function term_condition(Request $request){
   	if($request->method()=='GET'){
   		if(Session::get('mai_store_loggedin') == true){
   			$StoreId = session('mai_user_id');
				$user_detail = User::find(['id' => $StoreId])->first();
   			return view('UserPanel/addTerms',compact('user_detail'));
   		}else{
				return redirect('UserPanel/login');
			}
   	}

   	if($request->method()=='POST'){
   		$validations = [
				'terms_conditions' => 'required',
			];
			$Validator = Validator::make($request->all(),$validations);
			if($Validator->fails()){
				return redirect()->back()->withInput()->withErrors($Validator);
			}

   		$StoreId = session('mai_user_id');
			$user_detail = User::find(['id' => $StoreId])->first();
			$user_detail->store_terms = $request->terms_conditions;
			$user_detail->save();
			return redirect()->back()->with('terms_added','Terms & Conditions saved successfully.');
   	}
   }

   public function policy(Request $request){
   	if($request->method()=='GET'){
   		if(Session::get('mai_store_loggedin') == true){
   			$StoreId = session('mai_user_id');
				$user_detail = User::find(['id' => $StoreId])->first();
   			return view('UserPanel/addPolicy',compact('user_detail'));
   		}else{
				return redirect('UserPanel/login');
			}
   	}

   	if($request->method()=='POST'){
   		$validations = [
				'store_policy' => 'required',
			];
			$Validator = Validator::make($request->all(),$validations);
			if($Validator->fails()){
				return redirect()->back()->withInput()->withErrors($Validator);
			}

   		$StoreId = session('mai_user_id');
			$user_detail = User::find(['id' => $StoreId])->first();
			$user_detail->store_policy = $request->store_policy;
			$user_detail->save();
			return redirect()->back()->with('Policy_added','Policy saved successfully.');
   	}
   }
}
