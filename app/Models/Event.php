<?php

namespace App\Models;

use App\DB\Core\StringField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    // protected $fillable = [
    //     'type_id', 'event_name', 'details'
    // ];

    public function saveableFields(): array
    {
        return [
            'type_id' => StringField::new(),
            'event_name' => StringField::new(),
            'details' => StringField::new()
        ];
    }

    protected $hidden = [
        'type_id', 'details', 'created_at', 'updated_at'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function adHoc()
    {
        return $this->hasMany(AdHoc::class);
    }

    // public function eventImage()
    // {
    //     return $this->hasMany(EventImage::class);
    // }

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }

    public function eventImage()
    {
        return $this->hasOne(Image::class, 'link_id', 'id');
    }

    public static function boosted()
    {
        static::created(fn () => cache()->forget('city'));
        static::deleted(fn () => cache()->forget('city'));
    }

    public function forceDelete()
    {
        $this->forceDeleting = true;
        $this->booking()->forceDelete();
        $this->eventImage()->forceDelete();
        parent::forceDelete();
    }
    // public function cascadingEvent(int $id): bool
    // {
    //     $booking = $this->booking()->where('event_id', $id)->first();
    //     $booking->delete();
    //     $event = $this->eventImage()->where('link_id', $id)->where('genre', Config::get('variables.THREE'))->first();
    //     Storage::delete($event->upload_url);
    //     return $event->delete();
    // }
}
