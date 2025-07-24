<?php

namespace App\Http\Requests\MillingResultCalculation;

use App\Models\Paddy;
use Illuminate\Foundation\Http\FormRequest;

class MillingResultCalculateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'paddy_id' => 'required|exists:paddies,id',
            'initial_moisture_content' => 'required|numeric|min:13|max:23',
            'final_moisture_content' => 'required|numeric|min:13|max:14',
            'initial_bag_quantity' => 'required|numeric|min:500',
            'adjusted_weight' => 'sometimes|numeric',
            'white_rice_bags' => 'sometimes|integer',
            'broken_rice_bags' => 'sometimes|integer',
            'bran_bags' => 'sometimes|integer',
            'husk_bags' => 'sometimes|integer',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $paddyId = $this->input('paddy_id');
            $initialBagQuantity = $this->input('initial_bag_quantity');
            $paddy = Paddy::find($paddyId);

            if ($paddy && $initialBagQuantity > $paddy->bag_quantity) {
                $validator->errors()->add('initial_bag_quantity', "Initial bag quantity must not exceed the paddy's bag quantity (".$paddy->bag_quantity.').');
            }
        });
    }

    public function messages(): array
    {
        return [
            'paddy_id.required' => 'Paddy is required.',
            'paddy_id.exists' => 'Selected paddy does not exist.',
            'initial_moisture_content.required' => 'Initial moisture content is required.',
            'initial_moisture_content.numeric' => 'Initial moisture content must be a number.',
            'initial_moisture_content.min' => 'Initial moisture content must be at least 13%.',
            'initial_moisture_content.max' => 'Initial moisture content must not exceed 23%.',
            'final_moisture_content.required' => 'Final moisture content is required.',
            'final_moisture_content.numeric' => 'Final moisture content must be a number.',
            'final_moisture_content.min' => 'Final moisture content must be at least 13%.',
            'final_moisture_content.max' => 'Final moisture content must not exceed 14%.',
            'initial_bag_quantity.required' => 'Initial bag quantity is required.',
            'initial_bag_quantity.numeric' => 'Initial bag quantity must be a number.',
            'initial_bag_quantity.min' => 'Initial bag quantity must be at least 500.',
            'adjusted_weight.numeric' => 'Adjusted weight must be a number.',
            'white_rice_bags.integer' => 'White rice bags must be an integer.',
            'broken_rice_bags.integer' => 'Broken rice bags must be an integer.',
            'bran_bags.integer' => 'Bran bags must be an integer.',
            'husk_bags.integer' => 'Husk bags must be an integer.',
        ];
    }
}
