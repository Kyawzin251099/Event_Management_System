<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'name' => $this->name,
        ];
    }

    public function with($request)
    {
        return[
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/country'),
            'message' => 'Your action is successful'
        ];
    }
}
