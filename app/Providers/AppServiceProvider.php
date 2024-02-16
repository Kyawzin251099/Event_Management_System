<?php

namespace App\Providers;

use App\Models\PlatformUser;
use App\Models\Venue;
use App\Observers\PlatformUserObserver;
use App\Observers\VenueObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Venue::observe(VenueObserver::class);
        PlatformUser::observe(PlatformUserObserver::class);
    }
}
