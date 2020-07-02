<?php

namespace Modules\UserModule\Http\Resources\Vendor;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\UserModule\Http\Resources\Vendor\UserResource;

class UserImageResource extends JsonResource
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
            'id'                => (int) $this->id,
            'userId'            => (int) $this->user_id,
            'type'              => $this->type,
            'fileName'          => $this->file_name,
            'fileExtension'     => $this->file_extension,
            'fileSize'          => $this->file_size,
            'fileDimension'     => $this->file_dimension,
            'createdAt'         => $this->created_at,
            'updatedAt'         => $this->updated_at
        ];
    }
}
