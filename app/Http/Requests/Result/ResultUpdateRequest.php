<?php

namespace App\Http\Requests\Result;

use Illuminate\Foundation\Http\FormRequest;

class ResultUpdateRequest extends FormRequest
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
            'bag_quantity' => 'required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'bag_quantity.required' => 'The bag quantity field is required.',
            'bag_quantity.numeric' => 'The bag quantity must be a number.',
            'bag_quantity.min' => 'The bag quantity must be at least 1.',
        ];
    }
}
