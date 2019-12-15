<?php

namespace App\Http\Controllers\API\File;

use App\Http\Requests\API\File\AddRequest;
use App\Jobs\HttpDownload;
use App\Http\Requests\API\File\Add\UrlRequest;
use App\Models\HttpDownloadTask;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

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
     * @return float|ResponseFactory|Response
     */
    public function status(int $id)
    {
        if(HttpDownloadTask::find($id)) {
            $model = HttpDownloadTask::find($id);

            return response()->json([
                'task_id' => $model->id,
                'progress' => $model->progress,
                'status' => $model->status_id,
            ]);
        }

        return response(null,404);
    }
}
