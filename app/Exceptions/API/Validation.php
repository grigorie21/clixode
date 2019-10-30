<?php

namespace App\Exceptions\API;


use App\Response\ErrorResponse;

/**
 * Code 200-299 = Validation errors
 *
 * Class Validation
 * @package App\Exceptions\API
 */
class Validation extends ErrorResponse
{
    public $status = 'error';
    public $code;
    public $message;

    protected $httpCode;

    public function __construct(int $code, array $fields = [])
    {
        $httpCode = 400;

        switch ($code) {
            case 200:
                $message = 'Request validation error';
                $this->fields = $fields;
                break;

            default:
                $code = 999;
                $message = 'Unknown system error';
        }

//        parent::__construct($message, $code, null);

        $this->code = $code;
        $this->message = $message;
        $this->httpCode = $httpCode;
    }
}
