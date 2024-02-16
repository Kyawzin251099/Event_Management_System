<?php

namespace App\Http\Resources;

use App\Models\VenueComment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VenueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'venue_title' => $this->venue_title,
            'unit_type' => $this->unit_type,
            'capacity' => $this->capacity,
            'avail_start_date' => $this->avail_start_date,
            'avail_start_time' => $this->avail_start_time,
            'average_rating' => $this->venue_rating_avg_rating_id,
            'user' => new PlatformUserResource($this->whenLoaded('platformUser')),
            'venue_images' => ImageResource::collection($this->whenLoaded('venueImage')),
            'venue_comments' =>  VenueCommentResource::collection($this->whenLoaded('venueComment')),
            'venue_booking' => BookingResource::collection($this->whenLoaded('booking')),
        ];
    }

    public function with(Request $request)
    {
        return [
            'version' => '1.0.0',
            'api_url' => url('http://127.0.0.1:8000/api/venue'),
            'message' => 'Your action is successful!'
        ];
    }
}
