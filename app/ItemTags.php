<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemTags extends Model
{
    protected $table = 'item_tags';

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
