<?php

namespace App\Http\Requests\Paddy;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaddyRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'paddy_type_id' => 'required|exists:paddy_types,id',
            'bag_quantity' => 'required|numeric|min:1',
            'moisture_content' => 'required|numeric|min:13|max:23',
            'bag_weight' => 'required|numeric|min:50|max:80',
        ];
    }

    public function messages(): array
    {
        return [
            'bag_quantity.required' => 'The bag quantity field is required.',
            'bag_quantity.numeric' => 'The bag quantity must be a number.',
            'bag_quantity.min' => 'The bag quantity must be at least 1.',
            'bag_weight.required' => 'The bag weight field is required.',
            'bag_weight.numeric' => 'The bag weight must be a number.',
            'bag_weight.min' => 'The bag weight must be at least 50kg.',
            'bag_weight.max' => 'The bag weight must not exceed 80kg.',
            'moisture_content.numeric' => 'Moisture content must be a number.',
            'moisture_content.required' => 'The moisture content field is required.',
            'moisture_content.min' => 'Moisture content must be at least 13%.',
            'moisture_content.max' => 'Moisture content must not exceed 23%.',
        ];
    }
}
