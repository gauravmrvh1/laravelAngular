<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
	use SoftDeletes;
   protected $dates = ['deleted_at'];
   protected $table = 'users_testing';
   protected $fillable = ['deleted_at'];


}
