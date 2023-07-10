<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Base\BaseApiFormRequest;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class VariantUpdateRequest extends BaseApiFormRequest
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
            '%description' => 'nullable|string',
            '%specifications' => 'nullable|string',
        ]);
        $rules['price']=['required','numeric','min:1'];
        $rules['discount']=['nullable','numeric','min:0.1','max:100'];
        $rules['is_active']=['required','boolean'];
        $rules['values']=['required','array'];
        $rules['values.*']=['required','numeric'];
        $rules['image'] = ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg'];
        $rules['images'] = ['nullable', 'array'];
        $rules['images.*'] = ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg'];
        return $rules;
    }
}
