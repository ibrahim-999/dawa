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


class CompleteProfileStepTwoRequest extends FormRequest
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
            'vehicle_type' => ['required', 'string', 'max:30'],
            'vehicle_brand' => ['required', 'max:30'],
            'vehicle_plate_number' => ['required', 'string', 'max:30'],
            'driver_license' => ['required', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }
    
    public function failedValidation(Validator $validator) {
        $errors = $validator->errors();
        throw new ApiValidationException($errors->toArray(),$errors->first());
    }
}
