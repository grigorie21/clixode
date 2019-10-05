<?php


namespace App\Response;


class BaseResponse
{
    public $status;
    public $code;
    public $message;

    protected $httpCode;

    public function __construct(int $code)
    {

    }
}
