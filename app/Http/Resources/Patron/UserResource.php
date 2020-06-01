<?php

namespace App\Http\Resources\Patron;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Patron\UserPostResource;

class UserResource extends JsonResource
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
            'id'           => (int) $this->id,
            'name'         => $this->name,
            'posts'        => UserPostResource::collection($this->posts),
            'email'        => $this->email,
            'createdAt'    => $this->created_at,
            'updatedAt'    => $this->updated_at
        ];
    }
}
