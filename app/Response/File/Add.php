<?php

namespace App\Response\File;

use App\Response\BaseResponse;
use Illuminate\Support\Facades\Response\File;

/**
 * 300-399 = Success response
 *
 * Class Add
 * @package App\Response
 *
 */
class Add extends BaseResponse
{
//    public const status = 'success';
//    public $code;
//    public $message;

    protected $httpCode = 201;

    public function __construct(int $code)
    {
        switch ($code) {
            case 310:
                $this->code = $code;
                $this->message = 'File added to downloading task';
                break;

            default:
                return response()->json([
                    'status' => 'error',
                    'code' => 999,
                    'message' => 'Unknown system error',
                ], 400);
        }
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }
}
