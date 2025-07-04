<?php

namespace App\Http\Requests\AppointmentType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\AppointmentType;

class UpdateAppointmentTypeRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(AppointmentType::class)->ignore($this->appointment_type->id)->whereNull('deleted_at'),
            ],
            'description' => 'required',
        ];
    }
}
