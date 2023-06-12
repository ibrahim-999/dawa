<?php

namespace App\Http\Requests\Admin;

use App\Models\Driver;
use App\Models\User;
use App\Rules\DuplicateCustomPhoneCheck;
use App\Rules\DuplicatePhoneCheck;
use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateDriverRequest extends FormRequest
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
            'name' => ['required','max:255'],
            'is_active' => ['required','boolean'],
            // 'email' => ['required', 'email:rfc,dns', 'unique:drivers,email,'.$this->user->id],
            'email' => ['nullable', 'email', 'unique:drivers,email,'.$this->driver->id],
            'phone.code' => ['required', 'string', 'max:2'],
            'phone.number' => ['required', 'alpha_num', 'phone:phone.code', 'max:12', new DuplicateCustomPhoneCheck(new Driver(),$this->driver->id)],
            'password' => [
                'nullable',
                'confirmed',
                'string',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ];
    }

    public function messages()
    {
        return [
            'phone.number.phone' => __('messages.phone_match_country_code'),
        ];
    }
}
