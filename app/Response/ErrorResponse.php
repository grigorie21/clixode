<?php


namespace App\Response;


use App\Traits\ResponseTrait;
use Exception;

class ErrorResponse extends Exception
{
    use ResponseTrait;
}
