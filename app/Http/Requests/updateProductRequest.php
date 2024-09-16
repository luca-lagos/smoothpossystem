<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateProductRequest extends FormRequest
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
        $product = $this->route('product');
        return [
            'code' => 'required|unique:products,code,'.$product->id.'|max:50',
            'name' => 'required|unique:products,name,'.$product->id.'|max:50',
            'price' => 'required|unique:products,price,'.$product->id.'|max:100',
            'count' => 'required|unique:products,count,'.$product->id.'',
            'description' => 'nullable|max:255',
            'expiration_date' => 'nullable|date',
            'image_path' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'brand_id' => 'required|integer|exists:brands,id',
            'presentation_id' => 'required|integer|exists:presentations,id',
            'categories' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'brand_id' => 'marca',
            'presentation_id' => 'presentación'
        ];
    }
}
