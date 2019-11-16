<?php

namespace App\Http\Controllers\API\File;

use App\Http\Requests\API\File\AddRequest;
use App\Http\Requests\API\File\UploadRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddController extends Controller
{
    /**
     * Add file to bucket by url
     *
     * @param UploadRequest $request
     * @return JsonResponse
     */
    public function upload(UploadRequest $request)
    {
        dd(101, $request->all());
    }

    /**
     * Add file to bucket by url
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function url(AddRequest $request)
    {
        // Add download file task
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
