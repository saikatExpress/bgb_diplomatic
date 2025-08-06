<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBOPRequest extends FormRequest
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
        if(is_array($this->name)){
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
            'battalion_id' => 'required|exists:b_o_p_s,id',
            'name'         => 'required|array|unique:b_o_p_s,name',
            'name.*'       => 'required|string|max:250|unique:b_o_p_s,name',
            'lat'          => 'nullable|array',
            'lat.*'        => 'nullable|string|max:250',
            'lon'          => 'nullable|array',
            'lon.*'        => 'nullable|string|max:250',
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
            'battalion_id.required' => 'The battalion field is required.',
            'battalion_id.exists'   => 'The selected battalion does not exist.',
            'name.required'         => 'The name field is required.',
            'name.string'           => 'The name must be a string.',
            'name.max'              => 'The name may not be greater than 250 characters.',
            'name.unique'           => 'The name has already been taken.',
        ];
    }
}
