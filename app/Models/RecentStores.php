<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecentStores extends Model
{
    use SoftDeletes;
    protected $fillable = ['store_id','user_id'];
    protected $table = 'recent_stores';
}
