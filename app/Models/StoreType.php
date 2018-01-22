<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreType extends Model
{
		protected $fillable = ['name','store_type'];
    protected $table = 'store_cuisine_type';
}
