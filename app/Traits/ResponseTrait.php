<?php


namespace App\Traits;


trait ResponseTrait
{
    public $_status;
    protected $_code;
    public $_message;

    protected $httpCode;

    public function __construct(int $code = 99, int $httpCode = 403)
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

        dd(typeOf(get_parent_class()));
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
