<?php

namespace App\Http\Controllers\API\File;

use App\Exceptions\API\HttpHeader;
use App\Exceptions\API\Validation;
use App\Http\Requests\API\File\AddRequest;
use App\Response\ErrorResponse;
use App\Response\File\Add;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddController extends Controller
{
    /**
     * Add file to bucket
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function url(Request $request) : JsonResponse
    {
        try {
            switch ($request->header('content-type')) {
                case 'application/json':
                    $query = $request->json()->all();
                    break;

                case 'multipart/form-data':
                    $query = $request->all();
                    break;

                default:
                    throw new HttpHeader(800); //Unknown HTTP header "content-type"
            }

            $validator = Validator::make($query, (new AddRequest())->rules());

            if($validator->fails()) {
                throw new Validation(200, $validator->errors()->getMessages());
            } else {
                dd(new ErrorResponse());
                //Try to download file by URL | $query['url']

                $reponse = new Add(310);
                return response()->json($reponse, $reponse->get);
            }
        } catch (HttpHeader $e) {
            return response()->json($e, $e->getHttpCode());
        } catch (Validation $e) {
            return response()->json($e, $e->getHttpCode());
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
