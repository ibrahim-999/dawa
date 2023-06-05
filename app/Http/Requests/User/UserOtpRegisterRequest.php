<?php

namespace App\Http\Requests\User;

use App\Domains\Shared\v1\Exception\ApiValidationException;
use App\Models\User;
use App\Rules\DuplicatePhoneCheck;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserOtpRegisterRequest extends FormRequest
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
            'phone.number' => ['required', 'alpha_num', 'phone:phone.code', 'max:12', new DuplicatePhoneCheck(new User())],
            'phone.code' => ['required', 'string', 'max:2'],
            'name' => ['required', 'string', 'max:255'],
            'otp' =>  ['required', 'alpha_num','digits:4'],
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
