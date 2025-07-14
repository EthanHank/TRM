<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'name' => ['required', 'regex:/^[a-zA-Z]+$/', 'max:255', 'unique:roles,name,'.$this->role->id],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.regex' => 'The name field must contain only letters and no spaces.',
            'name.unique' => 'The name field already exists.',
        ];
    }
}
