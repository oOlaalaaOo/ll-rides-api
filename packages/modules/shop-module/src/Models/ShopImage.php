<?php

namespace Modules\ShopModule\Models;

use Illuminate\Database\Eloquent\Model;

class ShopImage extends Model
{
    protected $table = 'shop_images';

    public function shop()
    {
        return $this->belongsTo('Modules\ShopModule\Models\Shop');
    }
}
