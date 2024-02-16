<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatformUserRequest extends FormRequest
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
            'first_name' => 'required|string|regex:/^[a-zA-Z0-9 ]{2,20}$/',
            'middle_name' => 'nullable|string|regex:/^[a-zA-Z0-9 ]{2,20}$/',
            'last_name' => 'required|string|regex:/^[a-zA-Z0-9 ]{2,20}$/',
            'gender' => 'required',
            'email' => 'required|email|regex:/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i',
            'phone_no' => 'required|min:9|max:12',
            'commercial_name' => 'nullable|string|min:5|max:15',
            'password' => 'required|min:5|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{5,20}$/',
            //'upload_url' => 'nullable',
            'upload_url.*' => 'nullable|image|mimes:webp,jpg,png,jpeg,gif,svg|max:2048',
            'township_id' => 'required',
            'ward_name' => 'required',
            'street_name' => 'required',
            'block_no' => 'required',
            'floor' => 'required',
            'add_type' => 'required',
        ];
    }
}
