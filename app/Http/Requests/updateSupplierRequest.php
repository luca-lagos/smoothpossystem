<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateSupplierRequest extends FormRequest
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
        $supplier = $this->route('supplier');
        return [
            //
            'social_reason' => 'required|max:80',
            'location' => 'required|max:80',
            'document_id' => 'required|integer|exists:documents,id',
            'document_number' => 'required|max:20|unique:people,document_number,' . $supplier->people->id,
        ];
    }
}
