<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event_prize extends Model
{
    //
    protected $fillable = ['events_id','name','description','member_id'];
    public function event()
    {
        return $this->belongsTo(Event::class,'events_id','id');
    }
}
