<?php

namespace App\Http\Requests\Base;

use App\Domains\Shared\v1\Exception\ApiValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseApiFormRequest extends FormRequest
{

    public function failedValidation(Validator $validator) {
        $errors = $validator->errors();
        throw new ApiValidationException($errors->toArray(),$errors->first());
    }
}
