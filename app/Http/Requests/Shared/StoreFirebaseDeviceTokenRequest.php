<?php

namespace App\Http\Requests\Shared;

use Illuminate\Foundation\Http\FormRequest;

class StoreFirebaseDeviceTokenRequest extends FormRequest
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
            'device_id' => ['required', 'string', 'max:255'],
            'device_token' => ['required'],
            'device_type' => ['required', 'in:android,ios,desktop'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'device_id' => $this->header('X-Device'),
            'device_token' => $this->header('X-FcmToken'),
            'device_type' => $this->header('X-DeviceType'),
        ]);
    }
}
