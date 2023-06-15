<?php

namespace App\Http\Requests\Admin;

use App\Domains\User\v1\Enums\DiscountTypeEnum;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminStoreOfferRequest extends FormRequest
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
            '%title' => 'required|string',
            '%description' => ['nullable', 'string'],

            'image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg'],

            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],

            'discount_type' => ['required', Rule::in(DiscountTypeEnum::AMOUNT->value,DiscountTypeEnum::PRECENTAGE->value)],
            'discount' => ['required', 'numeric'],

            'get_amount' => ['required', 'numeric'],
            'buy_amount' => ['required', 'numeric'],

            'buyVariants' => ['required', 'array'],
            'buyVariants.*' => ['required', 'exists:variants,id'],

            'getVariants' => ['required', 'array'],
            'getVariants.*' => ['required', 'exists:variants,id'],
        ]);

        return $rules;

    }
    
}
