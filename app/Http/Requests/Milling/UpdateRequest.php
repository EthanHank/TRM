<?php

namespace App\Http\Requests\Milling;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'results' => 'required|array',
            'results.*' => 'required|integer|min:0',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'results.required' => 'The results field is required.',
            'results.array' => 'The results field must be an array.',
            'results.*.required' => 'Each result must be specified.',
            'results.*.integer' => 'Each result must be an integer.',
            'results.*.min' => 'Each result must be at least 0.',
        ];
    }
}
