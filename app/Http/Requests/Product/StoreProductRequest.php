<?php

namespace app\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'code' => 'nullable|string|max:50|unique:products,code',
            'quantity_alert' => 'nullable|integer|min:0',
            'tax' => 'nullable|numeric|min:0|max:100',
            'tax_type' => 'nullable|string',
            'notes' => 'nullable|string',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'expire_date' => 'nullable|date|after:today',
            'expire_date_toggle' => 'nullable|in:on',
            'location_ids' => 'required|array|min:1',
            'location_ids.*' => 'required|exists:locations,id',
            'quantities' => 'required|array|min:1',
            'quantities.*' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'location_ids.required' => 'At least one location is required',
            'location_ids.min' => 'At least one location is required',
            'quantities.required' => 'Please specify quantities for each location',
            'quantities.*.required' => 'Quantity is required for each location',
            'selling_price.gte' => 'Selling price must be greater than or equal to buying price',
        ];
    }
}
