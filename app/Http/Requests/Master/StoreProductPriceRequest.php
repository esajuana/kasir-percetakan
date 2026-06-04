<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductPriceRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',

            'product_variant_id' => 'nullable|exists:product_variants,id',

            'qty_min' => 'required|integer|min:1',

            'qty_max' => 'required|integer|gte:qty_min',

            'price' => 'required|numeric|min:0',

            'effective_from' => 'required|date',

            'effective_until' => 'nullable|date|after_or_equal:effective_from',

            'status' => 'required|boolean',
        ];
    }
}
