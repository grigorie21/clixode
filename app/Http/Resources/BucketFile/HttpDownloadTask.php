<?php

namespace App\Http\Resources\BucketFile;

use Illuminate\Http\Resources\Json\JsonResource;

class HttpDownloadTask extends JsonResource
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
            'task_id' => $this->id,
            'progress' => $this->progress,
            'status' => $this->status_id,
        ];
    }
}
