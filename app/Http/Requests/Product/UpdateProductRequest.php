<?php

namespace app\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'unit_id' => 'required|exists:units,id',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0|gte:buying_price',
            'code' => 'nullable|string|max:50|unique:products,code,' . $this->route('uuid') . ',uuid',
            'quantity_alert' => 'nullable|integer|min:0',
            'tax' => 'nullable|numeric|min:0|max:100',
            'tax_type' => 'nullable|string',
            'notes' => 'nullable|string',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'expire_date' => 'nullable|date|after:today',
            'expire_date_toggle' => 'nullable|in:on',
            'location_ids' => 'nullable|array',
            'location_ids.*' => 'exists:locations,id',
            'quantities' => 'nullable|array',
            'quantities.*' => 'integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'selling_price.gte' => 'Selling price must be greater than or equal to buying price',
        ];
    }
}
