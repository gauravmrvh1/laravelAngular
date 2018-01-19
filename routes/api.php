<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::match( ['get' , 'post'] , 'login' , 'AdminController@login');
Route::match( ['get' , 'post'] , 'dashboard' , 'AdminController@dashboard');
Route::match( ['get' , 'post'] , 'merchant_list' , 'AdminController@merchant_list');
Route::match( ['get' , 'post'] , 'user_list' , 'AdminController@user_list');
Route::get( 'logout' , 'AdminController@logout');


Route::get( 'profile' , 'AdminController@profile');
Route::match( ['get' , 'post'] , 'editProfile' , 'AdminController@editProfile');
Route::match( ['get' , 'post'] , 'changePassword' , 'AdminController@changePassword');
Route::match(['get','post'],'voucher_list','AdminController@voucher_list');
Route::match(['get','post'],'update_voucher_status/{voucher_id}/{status}','AdminController@update_voucher_status');
Route::match(['get','post'],'update_user_status/{user_id}/{status}','AdminController@update_user_status');
Route::match(['get','post'],'update_merchant_status/{merchant_id}/{status}','AdminController@update_merchant_status');





Route::match(['post'],'sign_up','CommonController@sign_up');
Route::post('login','CommonController@login');
Route::match(['post'],'social_sign_up_and_login','CommonController@social_sign_up_and_login');
Route::post('resendOtp','CommonController@resendOtp');
Route::post('otpVerify','CommonController@otpVerify');
Route::post('create_category','CategoryController@Create');
Route::post('create_country','CountryController@create');
Route::get('category_list','CategoryController@List');
Route::delete('category','CategoryController@delete');
Route::post('forgetPassword','CommonController@forgetPassword');



Route::group(['middleware'=>['ApiAuthentication']],function(){
	Route::post('logout','CommonController@logout');
	Route::post('complete_profile','CommonController@complete_profile');
	Route::post('change_password','CommonController@change_password');
	Route::post('change_passcode','CommonController@change_passcode');
	Route::post('update_profile','CommonController@update_profile');
	Route::post('home_data','UserPanelController@home_data');
	Route::post('get_data_by_category','UserPanelController@get_data_by_category');
	Route::post('sort_data','UserPanelController@sort_data');
});

///////////////////////////////////////////
/////
//////////////////////////////////////////

Route::post('get_city_under_country','CountryController@get_city_uder_country');
Route::post('get_area_uder_city','CountryController@get_area_uder_city');
Route::post('store_detail','UserPanelController@store_detail');