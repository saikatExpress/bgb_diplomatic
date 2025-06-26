<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
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
            'title'      => 'required|string|max:255',
            'input_name' => 'required|string|max:255',
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
            'title.required'      => 'The title field is required.',
            'title.string'        => 'The title must be a string.',
            'title.max'           => 'The title may not be greater than 255 characters.',
            'input_name.required' => 'The input name field is required.',
            'input_name.string'   => 'The input name must be a string.',
            'input_name.max'      => 'The input name may not be greater than 255 characters.',
        ];
    }
}