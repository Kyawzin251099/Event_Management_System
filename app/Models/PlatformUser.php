<?php

namespace App\Models;

use App\DB\Core\StringField;
use App\DB\Core\DatetimeField;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;


class PlatformUser extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes;

    protected $fillable = [
        'dept_id', 'commercial_name', 'first_name', 'middle_name',
        'last_name', 'dob', 'gender', 'phone_no', 'email', 'password', 'join_date',
        'resign_date',  'role', 'active', 'logged'
    ];

    public function saveableFields(): array
    {
        return [
            'role' => StringField::new(),
            'first_name' => StringField::new(),
            'middle_name' => StringField::new(),
            'last_name' => StringField::new(),
            'gender' => StringField::new(),
            'email' => StringField::new(),
            'phone_no' => StringField::new(),
            'commercial_name' => StringField::new(),
            'password' => StringField::new(),
            'dob' => DateTimeField::new(),
            'dept_id' => StringField::new(),
            'join_date' => DateTimeField::new(),
            'resign_date' => DateTimeField::new()
        ];
    }

    public static function isAdmin()
    {
        $userid = auth()->user()->id;
        $userDetais = PlatformUser::find($userid);
        if ($userDetais['role'] ===   Config::get('variables.TWENTY_THREE')) {
            return true;
        }
        return false;
    }

    public static function isPartner()
    {
        $userid = auth()->user()->id;
        $userDetais = PlatformUser::find($userid);
        if ($userDetais['role'] ===   Config::get('variables.THREE')) {
            return true;
        }
        return false;
    }

    public static function isNormalUser()
    {
        $userid = auth()->user()->id;
        $userDetais = PlatformUser::find($userid);
        if ($userDetais['role'] ===   Config::get('variables.ONE') || $userDetais['role'] ===   Config::get('variables.TWO')) {
            return true;
        }
        return false;
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }

    public function venue()
    {
        return $this->hasMany(Venue::class);
    }

    public function venueRating()
    {
        return $this->hasMany(VenueRating::class);
    }

    public function venueComment()
    {
        return $this->hasMany(VenueComment::class);
    }

    public function profileImage()
    {
        return $this->hasOne(ProfileImage::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function userImage()
    {
        return $this->hasOne(Image::class, 'link_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
    }

    public function checkBookStatus(int $platformUserID)
    {
        $platformUser = $this->with('venue.booking')->find($platformUserID);
        foreach ($platformUser->venue as $venue) {
            foreach ($venue->booking as $book) {
                if ($book->book_status !== Config::get('variables.ONE')) {
                    return true;
                }
            }
        }
        return false;
    }

    public function customCascadeUser(int $id): bool //delete image&address when a user deleted
    {
        $bookings = $this->booking()->where('platform_user_id', $id)->get();
        foreach ($bookings as $booking) {
            $booking->event()->delete();
        }

        $addresses = $this->address()->where('platform_user_id', $id)->get();
        foreach ($addresses as $address) {
            $address->street->ward()->delete();
        }

        $image = $this->userImage()->where('link_id', $id)->where('genre', Config::get('variables.ONE'))->first();
        Storage::delete($image->upload_url);
        return $image->delete();
    }
}
