<?php

namespace Modules\ShopModule\Http\Resources\Patron;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ShopModule\Http\Resources\Patron\UserResource;

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
            'id'           => (int) $this->id,
            'user_id'      => new UserResource($this->user_id),
            'name'         => $this->name,
            'address'      => $this->address,
            'latitude'     => $this->latitude,
            'longitude'    => $this->longitude,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at
        ];
    }
}
