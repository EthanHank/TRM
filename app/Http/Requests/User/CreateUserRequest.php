<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'password' => 'required|string|min:8',
            'nrc' => 'required|string|max:255|unique:users',
            'address' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'is_opened' => 'required|boolean',
            'role' => 'required|array',
            'role.*' => 'required|exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'full_name.required' => 'The full name field is required.',
            'phone.required' => 'The phone field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'nrc.required' => 'The NRC field is required.',
            'nrc.unique' => 'The NRC has already been taken.',
            'address.required' => 'The address field is required.',
            'gender.required' => 'The gender field is required.',
            'date_of_birth.required' => 'The date of birth field is required.',
            'is_opened.required' => 'The is opened field is required.',
            'role.required' => 'The role field is required.',
            'role.*.required' => 'The role field is required.',
            'role.*.exists' => 'The role does not exist.',
            'name.unique' => 'The name has already been taken.',
            'phone.unique' => 'The phone has already been taken.',
            'nrc.unique' => 'The NRC has already been taken.',
            'password.min' => 'The password must be at least 8 characters.',
            'gender.required' => 'The gender field is required.',
        ];
    }
}
