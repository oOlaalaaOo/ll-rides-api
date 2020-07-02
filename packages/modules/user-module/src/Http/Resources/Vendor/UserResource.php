<?php

namespace Modules\UserModule\Http\Resources\Vendor;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\UserModule\Http\Resources\Vendor\UserDetailResource;
use Modules\UserModule\Http\Resources\Vendor\UserImageResource;
use Modules\ShopModule\Http\Resources\Vendor\ShopResource;

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
            'email'        => $this->email,
            'details'      => new UserDetailResource($this->details),
            'images'       => UserImageResource::collection($this->images),
            'shops'        => ShopResource::collection($this->shops),
            'createdAt'    => $this->created_at,
            'updatedAt'    => $this->updated_at
        ];
    }
}
