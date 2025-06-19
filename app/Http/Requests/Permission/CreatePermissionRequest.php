<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class CreatePermissionRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:permissions,name'],
            'category' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'The name field must be a string.',
            'name.required' => 'The name field is required.',
            'name.max' => 'The name field must not be greater than 255 characters.',
            'name.unique' => 'The name field already exists.',
            'category.string' => 'The category field must be a string.',
            'category.required' => 'The category field is required.',
            'category.max' => 'The category field must not be greater than 255 characters.',
        ];
    }
}
