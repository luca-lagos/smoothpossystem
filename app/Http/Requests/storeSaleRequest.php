<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeSaleRequest extends FormRequest
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
            'date_time' => 'required',
            'tax' => 'required',
            'total' => 'required|numeric',
            'voucher_number' => 'required|unique:sales,voucher_number|max:255',
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'voucher_id' => 'required|exists:vouchers,id'
        ];
    }
}
