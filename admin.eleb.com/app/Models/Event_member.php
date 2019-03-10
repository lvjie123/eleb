<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event_member extends Model
{
    //
    public function event()
    {
        return $this->belongsTo(Event::class,'events_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'member_id','id');
    }
}
