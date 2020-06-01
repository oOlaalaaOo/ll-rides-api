<?php

namespace App\Http\Resources\Patron;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Patron\UserResource;
use App\Http\Resources\Patron\PostTagResource;
use App\Http\Resources\Patron\PostImageResource;

class PostResource extends JsonResource
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
            'createdAt'     => $this->created_at,
            'updatedAt'     => $this->updated_at
        ];
    }
}
