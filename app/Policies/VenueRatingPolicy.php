<?php

namespace App\Policies;

use App\Models\PlatformUser;
use App\Models\VenueRating;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Config;


class VenueRatingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(PlatformUser $platformUser): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(PlatformUser $platformUser, VenueRating $venueRating): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(PlatformUser $platformUser): bool
    {
        $user = PlatformUser::find($platformUser->id);
        return $user->role === Config::get('variables.ONE') || 
        $user->role === Config::get('variables.TWO');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(PlatformUser $platformUser, VenueRating $venueRating): bool
    {
        $user = PlatformUser::find($platformUser->id);
        return $user->id === $venueRating->platform_user_id ||
            $user->role === Config::get('variables.TWENTY_THREE');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(PlatformUser $platformUser, VenueRating $venueRating): bool
    {
        $user = PlatformUser::find($platformUser->id);
        return $user->id === $venueRating->platform_user_id ||
            $user->role === Config::get('variables.TWENTY_THREE');
    }

    /**
     * Determine whether the user can restore the model.
     */
   
}
