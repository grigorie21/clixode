<?php

namespace App\Http\Requests\API\File;

use App\Http\Requests\JsonRequest;

class AddRequest extends JsonRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bucket' => 'required|string',
            'url' => 'required|url',
        ];
    }
}
