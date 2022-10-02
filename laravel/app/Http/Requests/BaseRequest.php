<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $res = response()->json([
            'status'  => 400,
            'errors'  => $validator->errors(),
            'summary' => 'Failed validation.'
        ], 400);

        throw new HttpResponseException($res);
    }
}
