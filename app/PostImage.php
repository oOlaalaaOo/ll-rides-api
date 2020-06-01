<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $table = 'post_images';

    protected $fillable = [
        'post_id', 'title', 'description', 'file_name', 'file_mime', 'file_size', 'file_dimension'
    ];

    public function post()
    {
    	return $this->belongsTo('App\Post');
    }
}
