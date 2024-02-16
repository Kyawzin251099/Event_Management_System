<?php

namespace App\Http\Controllers;

use App\Contracts\BookingInterface;
use App\Contracts\EventInterface;
use App\Contracts\VenueInterface;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\EventRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Traits\ImageTrait;
use App\Traits\VenueTrait;
use Illuminate\Support\Facades\Config;

class BookingController extends Controller
{
    use ImageTrait, VenueTrait;
    private $genre;
    public function __construct(
        private BookingInterface $bookingInterface,
        private EventInterface $eventInterface,
    ) {
        $this->bookingInterface = $bookingInterface;
        $this->eventInterface = $eventInterface;
        $this->genre = Config::get('variables.THREE');

        $this->authorizeResource(Booking::class,'booking'); 

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $booking = Booking::all();
        // return BookingResource::collection($booking);
        $user_id = auth()->user()->id;
        $bookings = Booking::where('platform_user_id', $user_id)->where('book_status', Config::get('variables.TEN'))->get();    
        if (!$bookings) {
            return response()->json([
                'message' => 'There is no booking for you!',
            ], 500);
        }

        $bookingWithVenues = [];
        foreach ($bookings  as $key => $booking) {
            $bookingWithVenues[$key] = $this->venueDetails('Venue', $booking->venue_id);
        }

        return response()->json([
            'message' => 'All booking information for you',
            'bookingWithVenues' => $bookingWithVenues
        ], 200);
        return BookingResource::collection($booking);
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
    public function store(BookingRequest $request)
    {
        //store in event controller
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = $this->bookingInterface->findByID('Booking', $id);
        if (!$booking) {
            return response()->json([
                'message' => 'There is no booking for you',
            ], 200);
        }

        return response()->json([
            'message' => 'All booking information for you',
            'venues' => $booking
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(BookingRequest $request, Booking $booking)
    {
        $validatedData = $request->validated();
        
        $booking = $this->bookingInterface->findByID('Booking', $booking->id);
        // var_dump($booking);
        // exit;
        //$booking = Booking::find($id);
        if (!$booking) {
            return response()->json([
                'message' => 'Booking is not Found!',
            ], 400);
        }
        //event update
        // $event_data = [];
        // $event_data['type_id'] = $validatedData['type_id'];
        // $event_data['event_name'] = $validatedData['event_name'];
        // $event_data['details'] = $validatedData['details'];
        // $event = $this->eventInterface->update('Event', $event_data, $booking->event_id);
        // $this->storeImage($request, $event->id, $this->genre, $this->eventInterface);

        //booking update
        $booking_data = [];
        $booking_data['book_status'] = $validatedData['book_status'];
        $booking = $this->bookingInterface->update('Booking', $booking_data, $booking->id);

        return new BookingResource($booking);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking = $this->bookingInterface->findByID('Booking', $booking->id);

        // $booking = Booking::find($id);
        if (!$booking) {
            return response()->json([
                'message' => 'Booking is not found'
            ], 404);
        }
        $booking = $this->bookingInterface->delete('Booking', $booking->id);
        $this->eventInterface->delete('Event', $booking->event_id);
        $this->eventInterface->delete('Image', $booking->event_id);
        return new BookingResource($booking);
    }
}
