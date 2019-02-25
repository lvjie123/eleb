<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    protected $fillable = ['shop_category_id','shop_name','shop_img','shop_rating','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','notice','discount','status','status'];

    public function shop_categorie()
    {
        return $this->belongsTo(Shop_categorie::class,'shop_category_id','id');
    }

}
