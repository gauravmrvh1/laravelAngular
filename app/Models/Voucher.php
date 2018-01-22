<?php

namespace App\Models;
use \Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use \App\User;

class Voucher extends Model
{
    protected $table = 'vouchers';
    protected $fillable = ['store_id','code','description','point','validity','type'];

    public function getValidityAttribute($value){
    	return Carbon::parse($value)->format('d-M-Y');
    }

    public function store_detail(){
        return Self::hasOne(\App\User::class,'id','store_id');
    }

    public function getTypeAttribute($value){
    	if($value == 1){
    		return 'Free';
    	}
    	if($value == 2){
    		return 'Premium';
    	}
    }
}
