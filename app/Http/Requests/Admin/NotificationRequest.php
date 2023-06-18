<?php

namespace App\Http\Requests\Admin;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
        $rules = RuleFactory::make([
            '%title' => 'required',
            '%description' => ['required', 'string'],
            '%subject' => 'required_if:type,email',
            'type' => 'required',
            'sent_type' => 'required',
            'user_type' => 'required',
            'user_id' => 'required_if:user_type,users',
            'vendor_id' => 'required_if:user_type,vendors',
            'status' => 'required',
        ]);

        return $rules;
    }
}
