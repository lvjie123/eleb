<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['user_id','shop_id','sn','province','city','county','address','tel','name','total','status','out_trade_no'];
}
