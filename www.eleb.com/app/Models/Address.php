<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable = ['name','tel','province','city','county','address','user_id','is_default'];
}
