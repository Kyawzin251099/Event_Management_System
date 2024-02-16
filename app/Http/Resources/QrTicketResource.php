<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QrTicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ad_hoc_id' => $this->ad_hoc_id,
            'qr_code' => $this->qr_code
        ];
    }
    public function with(Request $request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://localhost:8000/api/qr_ticket'),
            'message' => 'Qr Code Ticket Action is Successfully'
        ];
    }
}
