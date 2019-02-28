<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    //
    protected $fillable = ['goods_name','category_id','goods_price','description','tips','goods_img'];
    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id','id');
    }
    public function menu_categorie()
    {
        return $this->belongsTo(Menu_categorie::class,'category_id','id');
    }
    public function img()
    {
        return $this->img?Storage::url($this->img):'/image/123.jpg';
    }
}
