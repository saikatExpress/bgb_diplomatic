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
            'country'   => 'required|in:bangladesh,india',
            'name'      => 'required|string|max:250|unique:regions,name',
            'latitude'  => 'nullable|string|min:5|max:250',
            'longitude' => 'nullable|string|min:5|max:250',
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
            'country.required' => 'The country is required.',
            'name.required'    => 'The region name is required.',
            'name.unique'      => 'The region name must be unique.',
        ];
    }
}