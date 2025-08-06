<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePillarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => trim($this->name),
            'lat'  => trim($this->lat),
            'lon'  => trim($this->lon),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'lat'         => 'nullable|string|max:255',
            'lon'         => 'nullable|string|max:255',
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
            'name.required'      => 'The name field is required.',
            'name.string'        => 'The name must be a string.',
            'name.max'           => 'The name may not be greater than 255 characters.',
            'description.string' => 'The description must be a string.',
        ];
    }
}
