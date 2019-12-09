<?php

namespace App\Http\Resources\BucketImage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BucketImageCollection extends ResourceCollection
{
    public $collects = BucketImageResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
