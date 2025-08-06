<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectorRequest extends FormRequest
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
        if (is_array($this->name)) {
            $this->merge([
                'name' => array_map('trim', $this->name),
                'lat'  => array_map('trim', $this->lat),
                'lon'  => array_map('trim', $this->lon),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'region_id'   => 'required|exists:regions,id',
            'name'        => 'required|array|min:1',
            'name.*'      => 'required|string|max:255',
            'lat'         => 'nullable|array',
            'lat.*'       => 'nullable|string|max:250',
            'lon'         => 'nullable|array',
            'lon.*'       => 'nullable|string|max:250',
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
            'region_id.required' => 'The region field is required.',
            'name.required'      => 'At least one sector name is required.',
            'name.*.required'    => 'The name field is required for all sectors.',
        ];
    }
}
