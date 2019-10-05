<?php

namespace App\Exceptions\API;


use App\Response\ErrorResponse;

/**
 * Code 100-199 = Authorization errors
 *
 * Class Authorization
 * @package App\Exceptions\API
 */
class Authorization extends ErrorResponse
{
    public $status = 'error';
    public $code;
    public $message;

    protected $httpCode;

    public function __construct(int $code, int $httpCode = 403)
    {
        switch ($code) {
            case 100:
                $message = 'Auth token not defined';
                break;

            case 101:
                $message = 'Access denied';
                break;

            default:
                $code = 999;
                $message = 'Unknown system error';
        }

        parent::__construct($message, $code, null);

        $this->code = $code;
        $this->message = $message;
        $this->httpCode = $httpCode;
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }
}
