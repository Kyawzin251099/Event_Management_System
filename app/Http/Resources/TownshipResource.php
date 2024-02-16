<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TownshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'city_id' => $this->city_id,
            'name' => $this->name
        ];
    }
    public function with(Request $request)
    {
        return[
            'version' => '1.0.0',
            'api_url' => url('http://localhost:8000/api/township'),
            'message' => 'Township Action is Successfully'
        ];
    }
}
