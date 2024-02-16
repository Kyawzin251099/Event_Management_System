<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //Bind the contracts and repositories
        $this->app->bind(
            'App\Contracts\CommonInterface',
            'App\Repositories\CommonRepository'
        );
        $this->app->bind(
            'App\Contracts\PlatformUserInterface',
            'App\Repositories\PlatformUserRepository'
        );
        $this->app->bind(
            'App\Contracts\TownshipInterface',
            'App\Repositories\TownshipRepository'
        );
        $this->app->bind(
            'App\Contracts\QrTickerInterface',
            'App\Repositories\QrTicketRepository'
        );
        $this->app->bind(
            'App\Contracts\WardInterface',
            'App\Repositories\WardRepository'
        );
        $this->app->bind(
            'App\Contracts\StreetInterface',
            'App\Repositories\StreetRepository'
        );
        $this->app->bind(
            'App\Contracts\AddressInterface',
            'App\Repositories\AddressRepository'
        );
        $this->app->bind(
            'App\Contracts\VenueInterface',
            'App\Repositories\VenueRepository'
        );
        $this->app->bind(
            'App\Contracts\CityInterface',
            'App\Repositories\CityRepository'
        );
        $this->app->bind(
            'App\Contracts\VenueRatingInterface',
            'App\Repositories\VenueRatingRepository'

        );
        $this->app->bind(
            'App\Contracts\TypeInterface',
            'App\Repositories\TypeRepository'
        );
        $this->app->bind(
            'App\Contracts\DepartmentInterface',
            'App\Repositories\DepartmentRepository'
        );
        $this->app->bind(
            'App\Contracts\EventInterface',
            'App\Repositories\EventRepository'
        );
        $this->app->bind(
            'App\Contracts\StateInterface',
            'App\Repositories\StateRepository'
        );
        $this->app->bind(
            'App\Contracts\CountryInterface',
            'App\Repositories\CountryRepository'

        );
        $this->app->bind(
            'App\Contracts\TownshipInterface',
            'App\Repositories\TownshipRepository'
        );
        $this->app->bind(
            'App\Contracts\QrTicketInterface',
            'App\Repositories\QrTicketRepository'
        );
        $this->app->bind(
            'App\Contracts\AdHocInterface',
            'App\Repositories\AdHocRepository'
        );
        $this->app->bind(
            'App\Contracts\VenueCommentInterface',
            'App\Repositories\VenueCommentRepository'
        );
        $this->app->bind(
            'App\Contracts\BookingInterface',
            'App\Repositories\BookingRepository'
        );
        $this->app->bind(
            'App\Contracts\PaymentInterface',
            'App\Repositories\PaymentRepository'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
