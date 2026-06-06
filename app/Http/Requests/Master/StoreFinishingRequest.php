<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class StoreFinishingRequest extends FormRequest
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
            'category_id' => [
                'required',
                'exists:categories,id'
            ],

            'name' => [
                'required',
                'max:100'
            ],

            'pricing_type' => [
                'required',
                'in:unit,area,length,perimeter,manual'
            ],

            'status' => [
                'required',
                'boolean'
            ],
        ];
    }
}
