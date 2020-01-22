<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\UserPostResource;

class UserPostResource extends ResourceCollection
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
            'user'          => UserPostResource::collection($this->user),
            'title'         => $this->title,
            'description'   => $this->description,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at
        ];
    }
}
