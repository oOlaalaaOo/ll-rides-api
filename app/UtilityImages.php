<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UtilityImages extends Model
{
    protected $table = 'utility_images';

    public function utility()
    {
        return $this->belongsTo('App\Utility');
    }
}
