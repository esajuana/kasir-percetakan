<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductVariantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $tiers = $this->price_tiers ?? [];

        foreach ($tiers as $key => $tier)
        {
            $tiers[$key]['normal_price'] =
                str_replace(
                    '.',
                    '',
                    $tier['normal_price'] ?? 0
                );

            $tiers[$key]['sponsor_price'] =
                str_replace(
                    '.',
                    '',
                    $tier['sponsor_price'] ?? 0
                );
        }

        $this->merge([
            'price_tiers' => $tiers
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'product_id' => [
                'required',
                'exists:products,id'
            ],

            'name' => [
                'required',
                'max:100'
            ],

            'status' => [
                'required',
                'boolean'
            ],

            'price_tiers' => [
                'nullable',
                'array'
            ],

            'price_tiers.*.product_option_id' => [
                'nullable',
                'exists:product_options,id'
            ],

            'price_tiers.*.qty_min' => [
                'required_with:price_tiers',
                'integer',
                'min:1'
            ],

            'price_tiers.*.qty_max' => [
                'required_with:price_tiers',
                'integer',
                'gte:price_tiers.*.qty_min'
            ],

            'price_tiers.*.normal_price' => [
                'required',
                'numeric',
                'min:0'
            ],

            'price_tiers.*.sponsor_price' => [
                'nullable',
                'numeric',
                'min:0'
            ],
        ];
    }
}
