<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\UserResource;
use App\Http\Resources\PostTagResource;
use App\Http\Resources\PostImageResource;

class PostResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => (int) $this->id,
            'user'          => new UserResource($this->user),
            'tags'          => new PostTagResource($this->tags),
            'images'        => new PostImageResource($this->images),
            'title'         => $this->title,
            'description'   => $this->description,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at
        ];
    }
}
