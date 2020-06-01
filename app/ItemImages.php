<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemImages extends Model
{
    protected $table = 'item_images';

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
