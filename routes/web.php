<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('header');
});

Auth::routes();

Route::group(['prefix' => 'Admin'], function () {
	
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

});




Route::group(['prefix' => 'UserPanel'] , function(){
	Route::match(['get','post'],'login','UserPanelController@login');
	Route::match(['get','post'],'logout','UserPanelController@logout');
	Route::match(['get','post'],'sign_up','UserPanelController@sign_up');
	Route::match(['get','post'],'index','UserPanelController@index');
	Route::match(['get','post'],'forget_password','UserPanelController@forget_password');
	Route::match(['get','post'],'store_detail','UserPanelController@store_detail');

	Route::match(['get','post'],'create_voucher','VoucherController@index');
	Route::match(['get'],'edit_voucher/{voucher_id}','VoucherController@edit');
	Route::match(['get'],'delete_voucher/{voucher_id}','VoucherController@delete');
	Route::match(['post'],'edit_voucher','VoucherController@edit');
	Route::match(['get','post'],'voucher_list','VoucherController@list');
	Route::match(['get','post'],'add_terms','TermConditionController@term_condition');
	Route::match(['get','post'],'add_policy','TermConditionController@policy');

	Route::get('gioLocation',function(){
		return view('UserPanel/gioLocation');
	});
});