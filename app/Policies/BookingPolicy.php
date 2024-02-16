<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\PlatformUser;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Config;

class BookingPolicy
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
    public function view(?PlatformUser $platformUser, Booking $booking): bool
    {
        return true;
    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(PlatformUser $platformUser, Booking $booking): bool
    {
        $user = PlatformUser::find($platformUser->id);
        return $user->role === Config::get('variables.TWENTY_THREE');
    }
    
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(PlatformUser $platformUser, Booking $booking): bool
    {
        $user = PlatformUser::find($platformUser->id);
        return $user->id === $booking->platform_user_id ||
        $user->role === Config::get('variables.TWENTY_THREE');
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(PlatformUser $platformUser, Booking $booking): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(PlatformUser $platformUser, Booking $booking): bool
    // {
    //     //
    // }
}
