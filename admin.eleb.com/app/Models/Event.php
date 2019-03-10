<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = ['title','content','signup_start','signup_end','prize_date','signup_num','is_prize'];
}
