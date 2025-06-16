<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncidentRequest extends FormRequest
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
            'title'       => 'required|string|max:250',
            'description' => 'nullable|string',
            'status'      => 'required|in:active,inactive',
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
            'title.required'       => 'The title field is required.',
            'title.string'         => 'The title must be a string.',
            'title.max'            => 'The title may not be greater than 250 characters.',
            'description.string'   => 'The description must be a string.',
            'status.required'      => 'The status field is required.',
            'status.in'            => 'The selected status is invalid. Please choose either active or inactive.',
        ];
    }
}
