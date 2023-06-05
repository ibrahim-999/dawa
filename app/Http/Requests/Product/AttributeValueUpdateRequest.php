<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Base\BaseApiFormRequest;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class AttributeValueUpdateRequest extends BaseApiFormRequest
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
            '%value_title' => 'required|string',
        ]);
        $rules['code']=['required','string','max:255'];
        return $rules;
    }
}
