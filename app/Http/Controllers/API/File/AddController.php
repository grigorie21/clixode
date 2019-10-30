<?php

namespace App\Http\Controllers\API\File;

use App\Http\Requests\API\File\AddRequest;
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
        dd($request->all());
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
