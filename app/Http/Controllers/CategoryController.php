<?php

namespace App\Http\Controllers;
use \App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
   public function Create(Request $request){
   	$category = json_decode($request->category);
   	foreach ($category as $key => $value) {
   		$data = Category::firstOrNew(['name'=>$value]);
   		$data->created_at = time();
   		$data->updated_at = time();
   		$data->save();
   	}
   	$response = [
   		'message' => 'Success',
   		'response' => Category::all()
   	];
   	return response()->json($response,__('messages.statusCode.ACTION_COMPLETE'));
   }

   public function List(Request $request){
   	$category = Category::all();
   	$response = [
   		'message' => 'Success',
   		'response' => $category
   	];
   	return response()->json($response,__('messages.statusCode.ACTION_COMPLETE'));
   }

   public function delete(Request $request){
   	$category_id = $request->header('category_id');
   	if($category_id){
   		$exist = Category::find($category_id);
	   	switch ($exist) {
	   		case count($exist) > 0:
	   			dd('hai');
	   			break;
	   		
	   		default:
	   			dd('else');
	   			break;
	   	}
   	}else{
   		$response = [
	   		'message' => $validator->errors($validator)->first(),
	   	];
	   	return response()->json($response,__('messages.statusCode.ACTION_COMPLETE'));
   	}
   	
   }
}
