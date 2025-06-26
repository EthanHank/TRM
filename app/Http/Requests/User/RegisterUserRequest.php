<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
                'name' => 'required|string|max:255|unique:users',
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:255|unique:users',
                'email' => 'required|email|max:255|unique:users',
                'nrc' => 'required|string|max:255|unique:users',
                'address' => 'required|string|max:255',
                'gender' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'full_name.required' => 'The full name field is required.',
            'phone.required' => 'The phone field is required.',
            'email.required' => 'The email field is required.',
            'nrc.required' => 'The nrc field is required.',
            'address.required' => 'The address field is required.',
            'gender.required' => 'The gender field is required.',
            'date_of_birth.required' => 'The date of birth field is required.',
            'date_of_birth.date' => 'The date of birth field must be a date.',
            'name.unique' => 'The name has already been taken.',
            'phone.unique' => 'The phone has already been taken.',
            'email.unique' => 'The email has already been taken.',
            'nrc.unique' => 'The nrc has already been taken.',
        ];
    }
}
