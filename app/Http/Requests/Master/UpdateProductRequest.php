<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',

            'code' => [
                'required',
                'max:50',
                Rule::unique('products')
                    ->ignore($this->product)
            ],

            'name' => 'required|max:255',

            'description' => 'nullable',

            'calculation_type' => 'required',

            'minimum_price' => 'required|numeric|min:0',

            'rounding_type' => 'required',

            'allow_finishing' => 'required|boolean',

            'is_package' => 'required|boolean',

            'manage_stock' => 'required|boolean',

            'status' => 'required|boolean',
        ];
    }
}
