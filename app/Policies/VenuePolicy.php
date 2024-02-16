<?php

namespace App\Policies;

use App\Models\PlatformUser;
use App\Models\Venue;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Config;



class VenuePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?PlatformUser $platformUser): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?PlatformUser $platformUser, Venue $venue): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(PlatformUser $platformUser): bool
    {
        $user = PlatformUser::find($platformUser->id);
        return $user->role === Config::get('variables.THREE');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(PlatformUser $platformUser, Venue $venue): bool
    {
       $user = PlatformUser::find($platformUser->id);
       return $user->id === $venue->platform_user_id ||
            $user->role === Config::get('variables.TWENTY_THREE');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(PlatformUser $platformUser, Venue $venue): bool
    {
        $user = PlatformUser::find($platformUser->id);
        return $user->id === $venue->platform_user_id ||
            $user->role === Config::get('variables.TWENTY_THREE');

    }

    /**
     * Determine whether the user can restore the model.
    //  */
    // public function restore(PlatformUser $platformUser, Venue $venue): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(PlatformUser $platformUser, Venue $venue): bool
    // {
    //     //
    // }
}
