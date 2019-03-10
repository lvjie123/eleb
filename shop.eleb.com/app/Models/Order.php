<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['status'];
    public function user()
    {
        return $this->belongsTo(Member::class,'user_id','id');
    }
}
