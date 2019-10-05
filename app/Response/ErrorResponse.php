<?php


namespace App\Response;


use Exception;

class ErrorResponse extends Exception
{
//    public $message = '123';

    public function __construct($message = null)
    {
        if($message) {
            $this->message = $message;
        }

        dd($this->message);
    }
}
