<?php

namespace Modules\UserModule\Http\Resources\Vendor;

use Illuminate\Http\Resources\Json\JsonResource;

use Modules\UserModule\Http\Resources\Vendor\UserResource;

class UserDetailResource extends JsonResource
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
            'userId'        => (int) $this->user_id,
            'description'   => $this->description,
            'address1'      => $this->address1,
            'address2'      => $this->address2,
            'state'         => $this->state,
            'country'       => $this->country,
            'city'          => $this->city,
            'zipcode'       => $this->zipcode,
            'mobileNo'      => $this->mobile_no,
            'telephoneNo'   => $this->telephone_no,
            'birthDate'     => $this->birthdate,
            'sex'           => $this->sex,
            'createdAt'     => $this->created_at,
            'updatedAt'     => $this->updated_at
        ];
    }
}
