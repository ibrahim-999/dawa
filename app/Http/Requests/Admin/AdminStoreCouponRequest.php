<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use App\Rules\DuplicatePhoneCheck;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminStoreCouponRequest extends FormRequest
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
            'code' => ['required', 'unique:coupons', 'min:2', 'max:6'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'discount_type' => ['required', Rule::in(1,2)],
            'discount' => ['required', 'numeric'],
            'min_purchases' => ['required', 'numeric'],
            'max_discount' => ['required_if:discount_type,2'],
            'num_uses_person' => ['required', 'numeric'],
            'num_uses' => ['required', 'numeric'],
            'categories' => ['required_without:products', 'array'],
            'categories.*' => ['required', 'exists:categories,id'],
            'products' => ['required_without:categories', 'array'],
            'products.*' => ['required', 'exists:products,id'],
        ];
    }
    
}
