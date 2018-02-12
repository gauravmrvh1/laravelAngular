<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Models\User;

class TestController extends Controller
{
	public function soft_delete(Request $request){
		$user_id = $request->user_id;
		if($user_id){
			$Exist = User::where('id',$user_id)->first();
			if($Exist){
				$Exist->deleted_at = time();
				$Exist->save();
				$response = [
					'message' =>'success',
				];
				return response()->json($response,200);
			}else{
				return 'already deleted';
			}
		}else{
			return 'invalid';
		}
	}   

	public function user_list_without_trashed(){
		$list_of_user = User::all();
		$response = [
			'message' =>'success',
			'list_of_user' => $list_of_user
		];
		return response()->json($response,200);
	}

	public function user_list_with_trashed(){
		$list_of_user = User::withTrashed()->get();
		$response = [
			'message' =>'success',
			'list_of_user' => $list_of_user
		];
		return response()->json($response,200);
	} 

	public function user_list_only_trashed(){
		$list_of_user = User::onlyTrashed()->get();
		$response = [
			'message' =>'success',
			'list_of_user' => $list_of_user
		];
		return response()->json($response,200);
	} 

	public function restore_deleted_user(){

		
		$list_of_user = User::onlyTrashed()->get();
		$response = [
			'message' =>'success',
			'list_of_user' => $list_of_user
		];
		return response()->json($response,200);
	} 



}
