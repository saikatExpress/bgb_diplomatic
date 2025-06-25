<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'battalion_id' => 'required|exists:battalions,id',
            'name'         => 'required|string|max:255',
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
            'battalion_id.required' => 'Battalion is required.',
            'battalion_id.exists'   => 'Selected battalion does not exist.',
            'name.required'         => 'Company name is required.',
            'name.string'           => 'Company name must be a string.',
            'name.max'              => 'Company name may not be greater than 255 characters.',
        ];
    }
}
