<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'battalion_id' => 'required|exists:battalions,id',
            'name'         => 'required|string|max:250|unique:companies,name',
            'lat'          => 'nullable|string|max:250',
            'lon'          => 'nullable|string|max:250',
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
            'battalion_id.required' => 'The battalion field is required.',
            'battalion_id.exists'   => 'The selected battalion does not exist.',
            'name.required'         => 'The company name is required.',
            'name.string'           => 'The company name must be a string.',
            'name.max'              => 'The company name may not be greater than 250 characters.',
            'name.unique'           => 'The company name has already been taken.',
        ];
    }
}