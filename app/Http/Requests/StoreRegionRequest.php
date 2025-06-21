<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegionRequest extends FormRequest
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
            'code'    => 'required|string|max:20|unique:regions,code',
            'country' => 'required|in:bangladesh,india',
            'name'    => 'required|string|max:250|unique:regions,name',
        ];
    }
    /**
     * Get custom messages for the validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'code.required'    => 'The region code is required.',
            'code.unique'      => 'The region code must be unique.',
            'country.required' => 'The country is required.',
            'name.required'    => 'The region name is required.',
            'name.unique'      => 'The region name must be unique.',
        ];
    }
}