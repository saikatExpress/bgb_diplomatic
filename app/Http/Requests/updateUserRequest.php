<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateUserRequest extends FormRequest
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
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
            'mobile' => ['required', 'string', 'max:15', 'unique:users,mobile,' . $this->user->id],
        ];
    }

      /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required'   => 'The name field is required.',
            'email.required'  => 'The email field is required.',
            'mobile.required' => 'The mobile field is required.',
        ];
    }
}