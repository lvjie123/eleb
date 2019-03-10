<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event_prize extends Model
{
    //
    public function User()
    {
        return $this->belongsTo(User::class,'member_id','id');
    }
}
