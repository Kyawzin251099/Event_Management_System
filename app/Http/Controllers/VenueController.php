<?php

namespace App\Http\Controllers;

use App\Contracts\VenueInterface;
use App\Http\Requests\VenueRequest;
use App\Http\Resources\VenueResource;
use App\Models\City;
use App\Models\Venue;
use App\Traits\CanLoadRelationships;
use App\Traits\HelperTrait;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class VenueController extends Controller
{
    use ImageTrait, HelperTrait, CanLoadRelationships;
    private $genre;
    private array $relations = [
        'platformUser', 'venueRating', 'venueImage', 'venueComment', 'booking.event.adHoc'
    ];
    
    public function __construct(private VenueInterface $venueInterface)
    {
        $this->middleware('throttle:api')->only(['index', 'store', 'show', 'delete']);
        $this->venueInterface = $venueInterface;
        $this->genre = Config::get('variables.TWO');

        $this->authorizeResource(Venue::class,'venue');

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = [
            'date' => request('date'),
            'township' => request('township'),
            'event_type' => request('event_type'),
        ];
        $query = $this->loadRelationships(Venue::SearchingVenue($filters));
        $cacheKey = 'venue:' . $filters['date'] . $filters['township'] . $filters['event_type'] . request()->input('include');
        $filteredVenues = cache()->remember($cacheKey, 60, fn () => $query->get());
        $trandingCities = cache()->remember('city', 60, fn () => $this->findTrendingCities());

        if ($filteredVenues->isEmpty()) {
            return response()->json([
                'message' => 'No venues match the given criteria',
                'venues' => [],
            ], 200);
        }
        return response()->json([
            "trending_venues" => VenueResource::collection($filteredVenues),
            "trending_cities" => $trandingCities,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VenueRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['platform_user_id'] = Auth::user()->id;
        unset($validatedData['upload_url']);
        $venue = $this->venueInterface->store('Venue', $validatedData);
        $request->hasFile('upload_url') ? $this->storeImage($request, $venue->id, $this->genre, $this->venueInterface) : false;
        return new VenueResource($venue);
    }


    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
        $cacheKey = 'venue:' . request()->input('include') . $venue->id;
        $venue = cache()->remember(
            $cacheKey,
            60,
            fn () => $this->loadRelationships($venue)
        );
        return new VenueResource($venue);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VenueRequest $request, Venue $venue)
    {
        $platform_usersArr = [
            'address_id', 'type_id', 'venue_title',
            'unit_type', 'capacity', 'avail_start_date', 'avail_end_date',
            'avail_start_time', 'avail_end_time', 'price', 'description'
        ];
        $validatedData = $request->validated();
        $validatedData['platform_user_id'] = Auth::user()->id;
        unset($validatedData['upload_url']);
        $venue = $this->venueInterface->findByID('Venue', $venue->id);
        if (!$venue) {
            return response()->json([
                'message' => 'The venue not found!',
            ], 500);
        }

        $venue = $this->hasChanges($validatedData, $venue, $platform_usersArr) ?
            $this->venueInterface->update('Venue', $validatedData, $venue->id) : $venue;

        $request->hasFile('upload_url') ? $this->storeImage($request, $venue->id, $this->genre, $this->venueInterface) : false;
        return new venueResource($venue);
    }

    public function destroy(Venue $venue)
    {
        // $status = $venue->customCascadingVenue($venue->id) ?
        //     $this->venueInterface->delete('Venue', $venue->id) : false;

        return $this->venueInterface->delete('Venue', $venue->id) ?
            response(status: 204) : response()->json([
                'message' => 'Currently, you cannot perform this action!'
            ]);
    }

    public function destroyImage($imageId) //delete image from ui
    {
        if ($this->deleteImage($imageId) != 'success') {
            return response()->json([
                'message' => 'Image does not exit.',
            ], 500);
        }
        return response()->json([
            'message' => 'Image successfully deleted!',
        ], 200);
    }

    private function findTrendingCities()
    {
        //trending cities
        $cities = City::orderBy('id', 'desc')->get();
        $selectedCities = $cities->pluck('name');

        $trending_cities = Venue::with('address.street.ward.township.city')
            ->whereHas('address.street.ward.township.city', function ($query) use ($selectedCities) {
                //$query->whereHas('street.ward.township.city', function ($query) use ($selectedCities) {
                $query->whereIn('name', $selectedCities);
            })->get();
        //})->get();
        $venuesByCity = $trending_cities->groupBy('address.street.ward.township.city.name');

        // Count the number of venues in each city
        return $venuesByCity->map->count();
    }
}
