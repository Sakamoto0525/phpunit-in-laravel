<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BaseRequest;

class UserCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name'     => 'string|required',
            'email'    => 'string|required',
            'password' => 'string|required'
        ];
    }
}
