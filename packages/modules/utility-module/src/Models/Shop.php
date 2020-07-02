<?php

namespace Modules\ShopModule\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function images()
    {
        return $this->hasMany('App\ShopImage');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function utilities()
    {
        return $this->hasMany('App\Utility');
    }
}
