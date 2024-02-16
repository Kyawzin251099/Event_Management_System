<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'role' => 'required',
            'first_name' => 'required|string|regex:/^[a-zA-Z0-9 ]{2,20}$/',
            'middle_name' => 'nullable|string|regex:/^[a-zA-Z0-9 ]{2,20}$/',
            'last_name' => 'required|string|regex:/^[a-zA-Z0-9 ]{2,20}$/',
            'email' => 'required|email|regex:/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i',
            'password' => 'required|min:5|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{5,20}$/',
            'dob' => 'required|date',
            'gender' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'role.required' => 'The role field is required.',
            'first_name.required' => 'The first name field is required.',
            'first_name.string' => 'The first name must be a string.',
            'first_name.regex' => 'The first name format is invalid. It should be 3 to 20 characters long and may contain letters, numbers, and spaces only.',
            'last_name.required' => 'The last name field is required.',
            'last_name.string' => 'The last name must be a string.',
            'last_name.regex' => 'The last name format is invalid. It should be 3 to 20 characters long and may contain letters, numbers, and spaces only.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.regex' => 'The email format is invalid.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 5 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.regex' => 'The password format is invalid. It should be 5 to 20 characters long and contain at least one letter, one number, and one special character.',
        ];
    }
}
