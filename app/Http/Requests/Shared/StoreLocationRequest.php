<?php

namespace App\Http\Requests\Shared;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
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
            'lat' => ['required'],
            'long' => ['required'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'lat' => $this->header('X-Lat'),
            'long' => $this->header('X-Lng')
        ]);
    }
}
