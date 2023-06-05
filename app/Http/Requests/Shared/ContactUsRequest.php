<?php

namespace App\Http\Requests\Shared;

use App\Domains\Shared\v1\Exception\ApiValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone.code' => ['required', 'string', 'max:2'],
            'phone.number' => ['required', 'alpha_num', 'phone:phone.code', 'max:12'],
            'message' =>  ['required'],
        ];
    }

    public function messages()
    {
        return [
            'phone.number.phone' => __('messages.phone_match_country_code'),
        ];
    }
    
    public function failedValidation(Validator $validator) {
        $errors = $validator->errors();
        throw new ApiValidationException($errors->toArray(),$errors->first());
    }
}
