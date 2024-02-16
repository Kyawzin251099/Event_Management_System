<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VenueRequest extends FormRequest
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
            'address_id' => 'required',
            'type_id' => 'required',
            'venue_title' => 'required',
            'unit_type' => 'required',
            'capacity' => 'required',
            'upload_url' => 'required',
            'upload_url.*' => 'image|mimes:png,jpg,jpeg,webp,gif,svg|max:2048',
            'avail_start_date' => 'required|date',
            'avail_end_date' => 'required|date',
            'avail_start_time' => 'required',
            'avail_end_time' => 'required',
            'price' => 'required',
            'description' => 'required'
        ];
    }
}
