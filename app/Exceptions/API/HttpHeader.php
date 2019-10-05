<?php

namespace App\Exceptions\API;


use App\Response\ErrorResponse;

/**
 * Code 800-899 = Http header errors
 *
 * Class HttpHeader
 * @package App\Exceptions\API
 */
class HttpHeader extends ErrorResponse
{
    public $status = 'error';
    public $code;
    public $message;

    protected $httpCode;

    public function __construct(int $code, int $httpCode = 400)
    {
        switch ($code) {
            case 800:
                $message = 'Unknown content type HTTP header';
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
