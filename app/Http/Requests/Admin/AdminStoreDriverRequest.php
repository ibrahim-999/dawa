<?php

namespace App\Http\Requests\Admin;

use App\Models\Driver;
use App\Models\User;
use App\Rules\DuplicatePhoneCheck;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AdminStoreDriverRequest extends FormRequest
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
            // 'email' => ['required', 'email:rfc,dns', 'unique:admins,email'],
            'email' => ['required', 'email', 'unique:drivers,email'],
            'phone.code' => ['required', 'string', 'max:2'],
            'phone.number' => ['required', 'alpha_num', 'phone:phone.code', 'max:12', new DuplicatePhoneCheck(new Driver())],
            'status' => ['required', 'integer'],
            'password' => [
                'required',
                'confirmed',
                'string',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],

            // 'is_active' => ['required',"in:yes,no"],
        ];
    }

    public function messages()
    {
        return [
            'phone.number.phone' => __('messages.phone_match_country_code'),
        ];
    }
    
    // public function attributes()
    // {
    //     if (!request()->wantsJson()) {
    //         return [
    //             'phone.code' => 'phone[code]',
    //             'phone.number' => 'phone[number]'
    //         ];
    //     } 
    // }
    // public function failedValidation(Validator $validator) {
    //     dd($validator);
    //     return $validator;
    // }
}
