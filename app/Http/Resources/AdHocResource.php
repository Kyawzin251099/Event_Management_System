<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdHocResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'event_id' => $this->event_id,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'phone_no' => $this->phone_no,
            'email' => $this->email
        ];
    }
    public function with(Request $request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://localhost:8000/api/adhoc'),
            'message' => 'Adhoc user and Qr Code Ticket Action are Created Successfully'
        ];
    }
}
