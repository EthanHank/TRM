<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
            'appointment_end_date' => 'required|date',
            'duration' => 'required|integer',
            'bag_quantity' => 'required|integer',
        ];
    }
}
