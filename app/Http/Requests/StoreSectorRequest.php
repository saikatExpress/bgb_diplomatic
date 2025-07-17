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
            'region_id' => 'required|exists:regions,id',
            'name'      => 'required|string|max:255',
            'lat'       => 'nullable|string|max:250',
            'lon'       => 'nullable|string|max:250',
            'status'    => 'required|in:active,inactive',
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
            'name.required'      => 'The name field is required.',
            'status.required'    => 'The status field is required.',
            'status.in'          => 'The selected status is invalid.',
        ];
    }
}