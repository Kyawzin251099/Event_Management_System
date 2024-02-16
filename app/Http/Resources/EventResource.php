<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'type_id' => $this->type_id,
            'event_name' => $this->event_name,
            'details' => $this->details
        ];
    }

    public function with($request)
    {
        return[
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/event'),
            'message' => 'Your action is successfull'
        ];
    }
}
