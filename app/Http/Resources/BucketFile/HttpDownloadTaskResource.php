<?php

namespace App\Http\Resources\BucketFile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HttpDownloadTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
     public function toArray($request): array
    {
        return [
            'task_id' => $this->id,
            'progress' => $this->progress,
            'status' => $this->ref_http_download_task_status_id,
            'bucket_id' => $this->bucket_id,
        ];
    }
}
