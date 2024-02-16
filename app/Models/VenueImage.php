<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenueImage extends Model
{
    protected $table = 'vw_venueimage';

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    protected $hidden = [
        'link_id',
        'genre',
    ];
}
