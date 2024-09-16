<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateCategoryRequest extends FormRequest
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
        $category = $this->route('category');
        $characteristic_id = $category->characteristic->id;

        return [
            "name" => "required|max:60|unique:characteristics,name," . $characteristic_id,
            "description" => "nullable|max:255"
        ];
    }
}
