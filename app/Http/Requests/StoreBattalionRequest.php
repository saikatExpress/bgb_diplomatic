<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBattalionRequest extends FormRequest
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
            'sector_id' => 'required|exists:sectors,id',
            'name'      => 'required|array|max:255',
            'name.*'    => 'required|string|max:255',
            'lat'       => 'nullable|array',
            'lat.*'     => 'nullable|string|max:255',
            'lon'       => 'nullable|array',
            'lon.*'     => 'nullable|string|max:255',
        ];
    }
    /**
     * Get the custom messages for the validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'sector_id.required' => 'The sector field is required.',
            'sector_id.exists'   => 'The selected sector does not exist.',
            'name.required'      => 'The name field is required.',
            'name.string'        => 'The name must be a string.',
            'name.max'           => 'The name may not be greater than 255 characters.',
            'name.*.required'    => 'The name field is required for all sectors.',
        ];
    }
}
