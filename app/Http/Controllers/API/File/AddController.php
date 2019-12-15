<?php

namespace App\Http\Controllers\API\File;

use App\Http\Requests\API\File\AddRequest;
use App\Jobs\HttpDownload;
use App\Http\Requests\API\File\Add\UrlRequest;
use App\Models\HttpDownloadTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddController extends Controller
{
    /**
     * Add file to bucket by url
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function url(UrlRequest $request)
    {
        HttpDownload::dispatch($request->url, $request->bucket);
    }

    /**
     * Return progress of current file/task
     *
     * @param int $id
     * @return float|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function status(int $id)
    {
        if(HttpDownloadTask::find($id)) {
            $progress = (float) HttpDownloadTask::find($id)->progress;
            return $progress;
        }
        return response(null,404);
    }
}
