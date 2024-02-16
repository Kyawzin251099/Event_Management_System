<?php

namespace App\Observers;

use App\Models\PlatformUser;
use Illuminate\Support\Facades\Config;

class PlatformUserObserver
{

    public function deleting(PlatformUser $platformUser)
    {
        $bookStatus = $platformUser->checkBookStatus($platformUser->id);
        //dd($bookStatus);
        if ($bookStatus) {
            return false;
        }

        $platformUser->userImage()->each(function ($image) use($platformUser) { //deleting platformUser images
            $image->where('link_id', $platformUser->id)->where('genre', Config::get('variables.ONE'))->delete();
        });

        $platformUser->address->each(function ($address) {
            $address->street->ward()->delete();
            $address->street()->delete();
            $address->delete();
        });

        $platformUser->venue()->each(function ($venue) {
            $venue->VenueImages()->where('genre', Config::get('variables.TWO'))->delete();
            $venue->delete();
        });

        $platformUser->booking()->each(function ($book) { //deleting event images
            $book->event->eventImage()->where('genre', Config::get('variables.THREE'))->delete();
            $book->event()->delete();
            $book->delete();
        });
        $platformUser->venueRating()->delete();
        $platformUser->venueComment()->delete();
    }

    public function restoring(PlatformUser $platformUser)
    {
        $platformUser->userImage()->withTrashed()->each(function ($image) { //deleting platformUser images
            $image->where('genre', Config::get('variables.ONE'))->restore();
        });

        $platformUser->address()->withTrashed()->each(function ($address) {
            $address->restore();
            $address->street()->withTrashed()->restore();
            $address->street->ward()->withTrashed()->restore();
        });

        $platformUser->venue()->withTrashed()->each(function ($venue) {
            $venue->restore();
            $venue->VenueImages()->withTrashed()->where('genre', Config::get('variables.TWO'))->restore();
        });

        $platformUser->booking()->withTrashed()->each(function ($book) { //deleting event images
            $book->restore();
            $book->event->withTrashed()->restore();
            $book->event->eventImage()->withTrashed()->where('genre', Config::get('variables.THREE'))->restore();
        });
        $platformUser->venueRating()->restore();
        $platformUser->venueComment()->restore();
    }
}
