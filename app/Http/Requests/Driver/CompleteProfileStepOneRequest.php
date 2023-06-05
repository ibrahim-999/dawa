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


class CompleteProfileStepOneRequest extends FormRequest
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
            'phone.code' => ['required', 'string', 'max:2'],
            'phone.number' => ['required', 'alpha_num', 'phone:phone.code', 'max:12', new DuplicateCustomPhoneCheck(new Driver(),request()->user()->id)],
            'name' => ['required', 'string', 'max:255'],
            'id_number' => ['required', 'string', 'max:30'],
            'id_number_image' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'nationality' => ['required', 'string', 'max:30'],
            'profile_image' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'otp' => ['nullable'],
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
