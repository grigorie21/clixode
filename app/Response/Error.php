<?php

namespace App\Response;

/**
 * Class Error
 * @package App\Response*
 */
class Error
{
    public function __construct(int $errorCode)
    {
        switch ($errorCode) {
            case 100:
                return response()->json([
                    'status' => 'error',
                    'err_code' => $errorCode,
                    'err_message' => 'Unknown content type header',
                ], 400);
                break;

            default:
                return response()->json([
                    'status' => 'error',
                    'err_code' => 999,
                    'err_message' => 'Unknown system error',
                ], 400);
        }
    }
}
