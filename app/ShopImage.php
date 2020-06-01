<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopImage extends Model
{
    protected $table = 'shop_images';

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }
}
