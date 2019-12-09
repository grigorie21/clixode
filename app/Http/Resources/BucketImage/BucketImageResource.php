<?php

namespace App\Http\Resources\BucketImage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BucketImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'images' => $this->images,
        ];
    }
}
