<?php

namespace App\Http\Controllers;

use App\Contracts\VenueRatingInterface;
use App\Http\Requests\VenueRatingRequest;
use App\Http\Resources\VenueRatingResource;
use App\Models\VenueRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VenueRatingController extends Controller
{
    //private VenueRatingInterface $venueRatingInterface;
    public function __construct(private VenueRatingInterface $venueRatingInterface)
    {
        $this->venueRatingInterface = $venueRatingInterface;
        $this->authorizeResource(VenueRating::class,'venue_rating');

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venues_rating = VenueRating::with('venue')->get();
        return VenueRatingResource::collection($venues_rating);
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
    public function store(VenueRatingRequest $request)
    {
        $validated_data = $request->validated();
        $validated_data['platform_user_id'] = Auth::user()->id;
        //$venue_rating = VenueRating::create($validated_data);
        $venue_rating = $this->venueRatingInterface->store('VenueRating', $validated_data);
        if (!$venue_rating) {
            return response()->json([
                'message' => 'Something wrong and please try again!'
            ], 401);
        }
        return new VenueRatingResource($venue_rating);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(VenueRatingRequest $request,VenueRating $venueRating)
    {
        $validated_data = $request->validated();
        $validated_data['platform_user_id'] = Auth::user()->id;
        //$venue_rating->update($validated_data);
        $venue_rating = $this->venueRatingInterface->update('VenueRating', $validated_data, $venueRating->id);
        return new VenueRatingResource($venue_rating);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VenueRating $venueRating)
    {
       return $this->venueRatingInterface->delete('VenueRating', $venueRating->id) ? response(status:204) : response(status:500);
    
    }
}
