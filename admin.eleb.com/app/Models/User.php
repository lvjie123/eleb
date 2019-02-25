<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $fillable = ['password'];
    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id','id');
    }
}
