<?php

namespace App\Http\Resources\Patron;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserPostResource;

class PostImageResource extends JsonResource
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
            'id'               => (int) $this->id,
            'post'             => new UserPostResource($this->post),
            'title'            => $this->title,
            'description'      => $this->description,
            'fileName'         => $this->file_name,
            'fileExtension'    => $this->file_extension,
            'fileSize'         => $this->file_size,
            'fileDimension'    => $this->file_dimension,
            'createdAt'        => $this->created_at,
            'updatedAt'        => $this->updated_at
        ];
    }
}
