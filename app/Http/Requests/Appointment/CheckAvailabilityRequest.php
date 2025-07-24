<?php

namespace App\Http\Requests\Appointment;

<<<<<<< HEAD
use App\Models\Paddy;
=======
>>>>>>> f9b296db933c0867d102e1edb53048082cbf7aa9
use Illuminate\Foundation\Http\FormRequest;

class CheckAvailabilityRequest extends FormRequest
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
            'paddy_id' => 'required|exists:paddies,id',
            'appointment_type_id' => 'required|exists:appointment_types,id',
            'appointment_start_date' => 'required|date',
<<<<<<< HEAD
            'bag_quantity' => 'required|numeric|min:500',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $paddyId = $this->input('paddy_id');
            $bagQuantity = $this->input('bag_quantity');
            $paddy = Paddy::find($paddyId);

            if ($paddy && $bagQuantity > $paddy->bag_quantity) {
                $validator->errors()->add('initial_bag_quantity', "Appointment bag quantity must not exceed the paddy's bag quantity (".$paddy->bag_quantity.').');
            }
        });
    }

=======
            'bag_quantity' => 'required|numeric|min:500|max:5000',
        ];
    }

>>>>>>> f9b296db933c0867d102e1edb53048082cbf7aa9
    public function messages(): array
    {
        return [
            'appointment_type_id.required' => 'The appointment type field is required.',
            'appointment_start_date.required' => 'The appointment start date field is required.',
            'bag_quantity.required' => 'The bag quantity field is required.',
            'bag_quantity.numeric' => 'The bag quantity must be a number.',
            'bag_quantity.min' => 'The bag quantity must be at least 500.',
<<<<<<< HEAD
=======
            'bag_quantity.max' => 'The bag quantity must not exceed 5000.',
>>>>>>> f9b296db933c0867d102e1edb53048082cbf7aa9
        ];
    }
}
