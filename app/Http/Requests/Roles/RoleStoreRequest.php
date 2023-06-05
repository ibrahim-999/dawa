<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
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
            'name' => ['required','max:255','unique:roles,name'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['required', 'exists:permissions,name'],
            'guard_name' => ['required', 'in:web-admin,web-vendor'],
        ];
    }
}
