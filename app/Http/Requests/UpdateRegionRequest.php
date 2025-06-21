<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRegionRequest extends FormRequest
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
            'code'    => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'name'    => 'required|string|max:255',
        ];
    }
    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'code.required'    => 'The code field is required.',
            'country.required' => 'The country field is required.',
            'name.required'    => 'The name field is required.',
            'code.max'         => 'The code may not be greater than 255 characters.',
            'country.max'      => 'The country may not be greater than 255 characters.',
            'name.max'         => 'The name may not be greater than 255 characters.',
        ];
    }
}