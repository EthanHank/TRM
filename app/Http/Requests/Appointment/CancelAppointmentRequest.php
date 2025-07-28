<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class CancelAppointmentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'cancel_reason' => 'required|string|min:10',
        ];
    }

    public function messages(): array
    {
        return [
            'cancel_reason.required' => 'The cancellation reason is required.',
            'cancel_reason.min' => 'The cancellation reason must be at least 10 characters long.',
        ];
    }
}
