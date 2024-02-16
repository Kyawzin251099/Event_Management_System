<?php

namespace App\Models;

use App\DB\Core\StringField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VenueComment extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['venue_id', 'platform_user_id', 'user_comment'];

    public function saveableFields(): array
    {
        return [
            'venue_id' => StringField::new(),
            'platform_user_id' => StringField::new(),
            'user_comment' => StringField::new()
        ];
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public static function boosted()
    {
        static::updated(fn (VenueComment $venueComment) => cache()->forget('venue:' . $venueComment->venue_id));
        static::deleted(fn (VenueComment $venueComment) => cache()->forget('venue:' . $venueComment->venue_id));
    }
}
