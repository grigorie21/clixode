<?php

namespace App\Http\Controllers\API;

use App\Jobs\HttpDownload;
use App\Response\Error;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    /**
     * Add file to bucket
     *
     * @param Request $request
     * @return Error
     */
    public function add(Request $request)
    {
        HttpDownload::dispatch();

        switch ($request->header('content-type')) {
            case 'application/json':
                $validator = Validator::make($request->json()->all(), [
                    'code' => 'required',
                    'description' => 'required',
                ]);

                dd($validator->errors());
                break;

            default:
                return new Error(100);
        }
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
