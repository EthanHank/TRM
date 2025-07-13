<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:users,name,'.$this->user->id,
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:users,phone,'.$this->user->id,
            'email' => 'required|email|max:255|unique:users,email,'.$this->user->id,
            'nrc' => 'required|string|max:255|unique:users,nrc,'.$this->user->id,
            'address' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The username field is required.',
            'name.unique' => 'The username has already been taken.',
            'full_name.required' => 'The full name field is required.',
            'phone.required' => 'The phone field is required.',
            'phone.unique' => 'The phone has already been taken.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'nrc.required' => 'The NRC field is required.',
            'nrc.unique' => 'The NRC has already been taken.',
            'address.required' => 'The address field is required.',
            'gender.required' => 'The gender field is required.',
            'date_of_birth.required' => 'The date of birth field is required.',
            'date_of_birth.date' => 'The date of birth must be a valid date.',
        ];
    }
}
