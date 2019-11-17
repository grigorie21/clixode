<?php

namespace App\Http\Controllers\API\File;

use App\Http\Requests\API\File\AddRequest;
use App\Jobs\HttpDownload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddController extends Controller
{
    /**
     * Add file to bucket
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function url(AddRequest $request)
    {
        HttpDownload::dispatch($request->url, $request->bucket);
    }

    /**
     * Return status of current file/task
     *
     * @param Request $request
     * @param int $id file/task ID
     */
    public function status(Request $request, int $id)
    {

    }
}
