<?php

namespace App\Models;

use App\DB\Core\StringField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VenueRating extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['platform_user_id', 'venue_id', 'rating_id'];

    public function saveableFields(): array
    {
        return [
            'platform_user_id' => StringField::new(),
            'venue_id' => StringField::new(),
            'rating_id' => StringField::new()
        ];
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function platformUser()
    {
        return $this->belongsTo(PlatformUser::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }

    public static function boosted()
    {
        static::updated(fn (VenueRating $venueRating) => cache()->forget('venue:' . $venueRating->venue_id));
        static::deleted(fn (VenueRating $venueRating) => cache()->forget('venue:' . $venueRating->venue_id));
    }
}
