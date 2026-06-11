<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class StoreFinishingVariantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $tiers = collect(
            $this->price_tiers ?? []
        )->map(function ($tier) {

            $tier['normal_price'] = str_replace(
                '.',
                '',
                $tier['normal_price'] ?? ''
            );

            $tier['sponsor_price'] = str_replace(
                '.',
                '',
                $tier['sponsor_price'] ?? ''
            );

            return $tier;
        });

        $this->merge([
            'price_tiers' => $tiers->toArray(),
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
            
            'finishing_id' => [
            'required',
            'exists:finishings,id'
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

            'price_tiers.*.qty_min' => [
                'required_with:price_tiers',
                'integer',
                'min:1'
            ],

            'price_tiers.*.qty_max' => [
                'required_with:price_tiers',
                'integer'
            ],

            'price_tiers.*.normal_price' => [
                'required_with:price_tiers',
                'numeric'
            ],

            'price_tiers.*.sponsor_price' => [
                'nullable',
                'numeric'
            ],
        ];
    }
}
