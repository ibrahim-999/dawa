<?php

namespace App\Http\Requests\Pharmacy;

use Illuminate\Foundation\Http\FormRequest;

class PharmacyStoreRequest extends FormRequest
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
            'info' => ['required','max:500'],
            'address' => ['required','max:500'],
            'chain_id' => ['required','exists:chains,id'],

            'lat' => ['required'],
            'long' => ['required'],
            'place_id' => ['required'],
        ];
    }
}
