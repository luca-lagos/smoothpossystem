<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeShopRequest extends FormRequest
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
            'supplier_id' => 'required|exists:suppliers,id',
            'voucher_id' => 'required|exists:vouchers,id',
            'voucher_number' => 'required|unique:shops,voucher_number|max:255',
            'tax' => 'required',
            'date_time' => 'required',
            'total' => 'required'
        ];
    }
}
