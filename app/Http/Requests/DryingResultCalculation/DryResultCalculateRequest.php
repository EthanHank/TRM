<?php

namespace App\Http\Requests\DryingResultCalculation;

use Illuminate\Foundation\Http\FormRequest;

class DryResultCalculateRequest extends FormRequest
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
            'paddy_type_id' => 'required|exists:paddy_types,id',
            'initial_moisture_content' => 'required|integer|min:14|max:23',
            'final_moisture_content' => 'required|integer|min:13|max:14',
            'initial_bag_quantity' => 'required|integer|min:100',
        ];
    }
    public function messages(): array
    {
        return [
            'paddy_type_id.required' => 'Paddy type is required.',
            'initial_moisture_content.required' => 'Initial moisture content is required.',
            'final_moisture_content.required' => 'Final moisture content is required.',
            'initial_bag_quantity.required' => 'Initial bag quantity is required.',
            'initial_moisture_content.integer' => 'Initial moisture content must be an integer.',
            'final_moisture_content.integer' => 'Final moisture content must be an integer.',
            'initial_bag_quantity.integer' => 'Initial bag quantity must be an integer.',
            'initial_moisture_content.min' => 'Initial moisture content must be at least 14%. If the moisture content is under 14%, it is not needed for drying. Your paddy is ready for milling.',
            'initial_moisture_content.max' => 'Initial moisture content must not exceed 23%.',
            'final_moisture_content.min' => 'Final moisture content must be at least 13%.',
            'final_moisture_content.max' => 'Final moisture content must not exceed 14%.',
            'initial_bag_quantity.min' => 'Initial bag quantity must be at least 100 bags.',
        ];
    }
}
