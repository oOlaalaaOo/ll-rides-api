<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    protected $table = 'user_images';

    protected $fillable = [
        'user_id', 'title', 'description', 'file_name', 'file_extension', 'file_size', 'file_dimension'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
