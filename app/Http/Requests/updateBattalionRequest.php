<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateBattalionRequest extends FormRequest
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
            'sector_id' => 'required|exists:sectors,id',
            'name'      => 'required|string|max:255',
            'lat'       => 'nullable|string|max:255',
            'lon'       => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom error messages for the validation rules.
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
        ];
    }
}