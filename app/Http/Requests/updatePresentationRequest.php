<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updatePresentationRequest extends FormRequest
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
        $presentation = $this->route('presentation');
        $characteristic_id = $presentation->characteristic->id;

        return [
            "name" => "required|max:60|unique:characteristics,name," . $characteristic_id,
            "description" => "nullable|max:255"
        ];
    }
}
