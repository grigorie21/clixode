<?php

namespace App\Http\Controllers\API\File;

use App\Http\Requests\API\File\AddRequest;
use App\Jobs\HttpDownload;
use App\Http\Requests\API\File\Add\UrlRequest;
use App\Models\HttpDownloadTask;
use App\Http\Controllers\Controller;
use App\Http\Resources\BucketFile\HttpDownloadTask as HttpDownloadTaskResource;

class AddController extends Controller
{
    /**
     * Add file to bucket by url
     *
     * @param UrlRequest $request
     */
    public function url(UrlRequest $request)
    {
        HttpDownload::dispatch($request->url, $request->bucket);
    }

    /**
     * Return progress of current file/task
     *
     * @param int $id
     * @return \App\Http\Resources\BucketFile\HttpDownloadTask
     */
    public function status(int $id)
    {
        if(HttpDownloadTask::find($id)) {
            return new HttpDownloadTaskResource(HttpDownloadTask::find($id));
        }

        return response(null,404);
    }
}
