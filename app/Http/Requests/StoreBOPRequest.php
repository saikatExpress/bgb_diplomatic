<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBOPRequest extends FormRequest
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
            'company_id' => 'required|exists:companies,id',
            'name'       => 'required|string|max:250|unique:b_o_p_s,name',
            'lat'        => 'nullable|string|max:250',
            'lon'        => 'nullable|string|max:250',
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
            'company_id.required' => 'The company field is required.',
            'company_id.exists'   => 'The selected company does not exist.',
            'name.required'       => 'The name field is required.',
            'name.string'         => 'The name must be a string.',
            'name.max'            => 'The name may not be greater than 250 characters.',
            'name.unique'         => 'The name has already been taken.',
        ];
    }
}