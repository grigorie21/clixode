<?php

namespace App\Http\Controllers\API\File;

use App\Http\Resources\Error;
use App\Jobs\HttpDownload;
use App\Http\Requests\API\File\Add\UrlRequest;
use App\Models\HttpDownloadTask;
use App\Http\Controllers\Controller;
use App\Http\Resources\BucketFile\HttpDownloadTaskResource;
use Illuminate\Http\JsonResponse;


class AddController extends Controller
{
    /**
     * Add file to bucket by url
     *
     * @param UrlRequest $request
     * @return HttpDownloadTaskResource|JsonResponse
     */
    public function url(UrlRequest $request)
    {
        $task = HttpDownloadTask::create([
            'url' => $request->url,
            'ref_http_download_task_status_id' => '1',
            'progress' => 0,
            'bucket_id' => $request->bucket_id,
        ]);

        HttpDownload::dispatch($task->id);

        return new HttpDownloadTaskResource($task);
    }

    /**
     * Return progress of current file/task
     *
     * @param int $id
     * @return HttpDownloadTaskResource
     */
    public function status(int $id)
    {
        if (HttpDownloadTask::find($id)) {
            return new HttpDownloadTaskResource(HttpDownloadTask::find($id));
        }

        return Error::error404("There's no {$id} id");
    }
}
