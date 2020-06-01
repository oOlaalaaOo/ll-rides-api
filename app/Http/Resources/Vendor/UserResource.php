<?php

namespace App\Http\Resources\Vendor;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Vendor\UserImageResource;

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
            'images'       => UserImageResource::collection($this->images),
            'name'         => $this->name,
            'email'        => $this->email,
            'createdAt'    => $this->created_at,
            'updatedAt'    => $this->updated_at
        ];
    }
}
