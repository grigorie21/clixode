<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class JsonRequest extends FormRequest
{
    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        if($this->header('content-type') === 'application/json') {
            return $this->json()->all();
        } else {
            return $this->all();
        }
    }
}
