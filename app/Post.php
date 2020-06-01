<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id', 'title', 'description',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function tags()
    {
    	return $this->hasMany('App\PostTag');
    }

    public function images()
    {
    	return $this->hasMany('App\PostImage');
    }
}
