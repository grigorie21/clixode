<?php

namespace App\Http\Resources\BucketFile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BucketFileCollection extends ResourceCollection
{
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
