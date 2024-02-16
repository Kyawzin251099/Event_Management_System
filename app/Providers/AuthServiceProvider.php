<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Venue;
use App\Models\VenueComment;
use App\Models\VenueRating;
use App\Policies\BookingPolicy;
use App\Policies\EventPolicy;
use App\Policies\PlatformUserPolicy;
use App\Policies\VenueCommentPolicy;
use App\Policies\VenuePolicy;
use App\Policies\VenueRatingPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Event::class => EventPolicy::class,
        Venue::class => VenuePolicy::class,
        Booking::class => BookingPolicy::class,
        VenueComment::class=> VenueCommentPolicy::class,
        VenueRating::class=> VenueRatingPolicy::class,
       // PlatformUser::class => PlatformUserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
