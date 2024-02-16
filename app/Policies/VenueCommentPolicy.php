<?php

namespace App\Policies;

use App\Models\PlatformUser;
use App\Models\VenueComment;
use Illuminate\Support\Facades\Config;

class VenueCommentPolicy
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
    public function view(PlatformUser $platformUser, VenueComment $venueComment): bool
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
    public function update(PlatformUser $platformUser, VenueComment $venueComment): bool
    {
        $user = PlatformUser::find($platformUser->id);
        return $user->id === $venueComment->platform_user_id ||
            $user->role === Config::get('variables.TWENTY_THREE');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(PlatformUser $platformUser, VenueComment $venueComment): bool
    {
        $user = PlatformUser::find($platformUser->id);
        return $user->id === $venueComment->platform_user_id ||
            $user->role === Config::get('variables.TWENTY_THREE');
    }

}
