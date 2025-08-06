<?php

namespace App\Http\Requests\Milling;

use Illuminate\Foundation\Http\FormRequest;

class MakeMillRequest extends FormRequest
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
            'appointment_id' => 'required|exists:appointments,id',
        ];
    }

    public function messages()
    {
        return [
            'appointment_id.required' => 'The appointment ID is required.',
            'appointment_id.exists' => 'The selected appointment does not exist.',
        ];
    }
}
