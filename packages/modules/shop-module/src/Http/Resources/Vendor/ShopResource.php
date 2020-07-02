<?php

namespace Modules\ShopModule\Http\Resources\Vendor;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\UserModule\Http\Resources\Vendor\UserResource;

class ShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (int) $this->id,
            'userId' => (int) $this->user_id,
            'name' => $this->name,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
