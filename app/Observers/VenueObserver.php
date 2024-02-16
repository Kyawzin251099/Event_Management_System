<?php

namespace App\Observers;

use App\Models\Venue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class VenueObserver
{
    public function deleting(Venue $venue)
    {
        $book_status = $venue->checkBookStatus($venue->id);
        //dd($book_status);
        if ($book_status) {
            return false;
        }

        $venue->VenueImages()->each(function ($image)  use ($venue) { //deleting venue images
            $image->where('link_id', $venue->id)->where('genre', Config::get('variables.TWO'))->delete();
        });
        $venue->booking()->each(function ($book) { //deleting event images
            $book->event->eventImage()->where('genre', Config::get('variables.THREE'))->delete();
            $book->event->delete();
            $book->delete();
        });
        $venue->venueRating()->delete();
        $venue->venueComment()->delete();
    }

    public function restoring(Venue $venue): void
    {
        //$venue->images()->restore();
        $venue->VenueImages()->withTrashed()->each(function ($image) use ($venue) {
            $image->where('link_id', $venue->id)->where('genre', Config::get('variables.TWO'))->restore();
        });
        $venue->booking()->withTrashed()->each(function ($book) {
            $book->restore();
            $book->event()->withTrashed()->restore();
            $book->event->eventImage()->withTrashed()->where('genre', Config::get('variables.THREE'))->restore();
        });

        $venue->venueRating()->restore();
        $venue->venueComment()->restore();
    }
}
