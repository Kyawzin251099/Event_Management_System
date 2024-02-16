<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdHocRequest extends FormRequest
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
            'event_id' => ['required'],
            'first_name' => ['required', 'string'],
            'middle_name' => ['string'],
            'last_name' => ['string'],
            'phone_no' => ['required', 'string'],
            'email' => ['email', 'required']
        ];
    }
}
