<?php

namespace App\Http\Controllers;

use App\Contracts\VenueInterface;
use App\Http\Resources\VenueResource;
use App\Models\City;
use App\Models\PlatformUser;
use App\Models\Venue;
use App\Models\VenueImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct(private VenueInterface $venueInterface)
    {
        $this->venueInterface = $venueInterface;
    }
    public function index()
    {
        $all_venues = Venue::orderBy('id', 'desc')->get();
        if (!$all_venues) {
            return response()->json([
                'message' => 'No venue found!',
            ], 500);
        }

       
        //trending venues
        $trending_venues = $this->venueInterface->venueDetails('Venue')->get();
        $cityVenueCounts = $this->findTrendingCities();


        return response()->json([
            "trending_venues" => VenueResource::collection($trending_venues),
            "trending_cities" => $cityVenueCounts
        ], 200);
    }

    private function findTrendingCities()
    {
        //trending cities
        $cities = City::orderBy('id', 'desc')->get();
        $selectedCities = $cities->pluck('name');

        $trending_cities = Venue::with('address.street.ward.township.city')
            ->whereHas('address', function ($query) use ($selectedCities) {
                $query->whereHas('street.ward.township.city', function ($query) use ($selectedCities) {
                    $query->whereIn('name', $selectedCities);
                });
            })->get();
        $venuesByCity = $trending_cities->groupBy('address.street.ward.township.city.name');

        // Count the number of venues in each city
        return $venuesByCity->map->count();
    }
}
