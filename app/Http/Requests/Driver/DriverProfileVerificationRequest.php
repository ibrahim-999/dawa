<?php

namespace App\Http\Requests\Driver;

use App\Domains\Shared\v1\Exception\ApiValidationException;
use App\Domains\Shared\v1\Traits\ApiResponseTrait;
use App\Models\Driver;
use App\Rules\DuplicateCustomPhoneCheck;
use App\Rules\DuplicatePhoneCheck;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;


class DriverProfileVerificationRequest extends FormRequest
{
    use ApiResponseTrait;
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
            'phone_code' => ['required', 'string', 'max:2'],
            'phone_number' => ['required', 'alpha_num', 'phone:phone_code', 'max:12', new DuplicateCustomPhoneCheck(new Driver(),request()->user()->id)],
            'otp' => ['required'],
        ];
    }
    public function failedValidation(Validator $validator) {
        $errors = $validator->errors();
        throw new ApiValidationException($errors->toArray(),$errors->first());
    }
}
