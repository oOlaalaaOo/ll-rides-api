<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    protected $table = 'utitities';

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

    public function images()
    {
        return $this->hasMany('App\UtilityImage');
    }
}
