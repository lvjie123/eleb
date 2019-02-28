<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu_categorie extends Model
{
    //
    protected $fillable = ['name','description','is_selected','shop_id','type_accumulation'];
    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id','id');
    }
}
