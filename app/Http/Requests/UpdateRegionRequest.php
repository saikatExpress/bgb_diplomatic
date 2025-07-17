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

    public function prepareForValidation()
    {
        $this->merge([
            'name'      => trim($this->name),
            'latitude'  => trim($this->lat),
            'longitude' => trim($this->lon),
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
            'country'   => 'required|string|max:255',
            'name'      => 'required|string|max:255',
            'latitude'  => 'nullable|string|max:255',
            'longitude' => 'nullable|string|max:255'
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
            'country.required' => 'The country field is required.',
            'name.required'    => 'The name field is required.',
            'country.max'      => 'The country may not be greater than 255 characters.',
            'name.max'         => 'The name may not be greater than 255 characters.',
        ];
    }
}