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


class CompleteProfileStepThreeRequest extends FormRequest
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
            'payment_service' => ['required', 'in:bank_account,stc_pay'],
            'account_holder_name' => ['required_if:payment_service,bank_account', 'string'],
            'iban_number' => ['required_if:payment_service,bank_account', 'string', 'max:30'],
            'stc_number' => ['required_if:payment_service,stc_pay', 'string'],
        ];
    }
    
    public function failedValidation(Validator $validator) {
        $errors = $validator->errors();
        throw new ApiValidationException($errors->toArray(),$errors->first());
    }
}
