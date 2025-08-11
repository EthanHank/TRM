<?php

namespace App\Http\Requests\Drying;

use Illuminate\Foundation\Http\FormRequest;

class CompleteDryingRequest extends FormRequest
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
            'bag_quantity' => 'required|numeric|min:500',
            'bag_weight' => 'required|numeric|min:50',
        ];
    }

    public function messages()
    {
        return [
            'bag_quantity.required' => 'The bag quantity field is required.',
            'bag_quantity.numeric' => 'The bag quantity must be a number.',
            'bag_quantity.min' => 'The bag quantity must be at least 500kg.',
            'bag_weight.required' => 'The bag weight field is required.',
            'bag_weight.numeric' => 'The bag weight must be a number.',
            'bag_weight.min' => 'The bag weight must be at least 50kg.',
        ];
    }
}
