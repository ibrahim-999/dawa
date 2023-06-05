<?php

namespace App\Http\Requests\User;

use App\Domains\Shared\v1\Exception\ApiValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateProfileImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }
    public function failedValidation(Validator $validator) {
        $errors = $validator->errors();
        throw new ApiValidationException($errors->toArray(),$errors->first());
    }
}
