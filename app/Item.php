<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

    public function images()
    {
        return $this->hasMany('App\ItemImage');
    }

    public function tags()
    {
        return $this->hasMany('App\ItemTag');
    }
}
