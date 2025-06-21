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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'region_id' => 'required|exists:regions,id',
            'code'      => 'required|string|max:10|unique:sectors,code',
            'name'      => 'required|string|max:255',
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
            'code.required'      => 'The code field is required.',
            'code.unique'        => 'The code has already been taken.',
            'name.required'      => 'The name field is required.',
            'status.required'    => 'The status field is required.',
            'status.in'          => 'The selected status is invalid.',
        ];
    }
}