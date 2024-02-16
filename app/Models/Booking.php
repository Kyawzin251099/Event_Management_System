<?php

namespace App\Models;

use App\DB\Core\StringField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;
    //protected $fillable = ['platform_user_id', 'venue_id', 'event_id', 'book_status'];

    public function saveableFields(): array

    {
        return [
            'venue_id' => StringField::new(),
            'platform_user_id' => StringField::new(),
            'event_id' => StringField::new(),
            'book_status' => StringField::new()
        ];
    }

    protected $hidden = [
        'platform_user_id', 'book_status', 'created_at', 'updated_at',
    ];

    public function platformUser()
    {
        return $this->belongsTo(PlatformUser::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
