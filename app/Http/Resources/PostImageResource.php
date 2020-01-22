<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\UserPostResource;

class PostImageResource extends ResourceCollection
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
            'post'              => UserPostResource::collection($this->post),
            'title'             => $this->title,
            'description'       => $this->description,
            'file_name'         => $this->file_name,
            'file_extension'    => $this->file_extension,
            'file_size'         => $this->file_size,
            'file_dimension'    => $this->file_dimension,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at
        ];
    }
}
