<?php

namespace App\Http\Controllers;

use App\Contracts\BookingInterface;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Contracts\EventInterface;
use App\Contracts\VenueInterface;
use App\Http\Resources\EventResource;
use App\Models\Image;
use App\Models\Qrgenerate;
use App\Models\Venue;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Config;

class EventController extends Controller
{
    use ImageTrait;
    private $genre;
    public function __construct(
        private EventInterface $eventInterface,
        private BookingInterface $bookingInterface
    ) {
        $this->eventInterface = $eventInterface;
        $this->bookingInterface = $bookingInterface;
        $this->genre = Config::get('variables.THREE');

        $this->authorizeResource(Event::class,'event'); 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = Event::all();
        return EventResource::collection($event);
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
    public function store(EventRequest $request)
    {
        $validatedData = $request->validated();
        unset($validatedData['upload_url']);
        unset($validatedData['venue_id']);
        $event = $this->eventInterface->store('Event', $validatedData);
        $this->storeImage($request, $event->id, $this->genre, $this->eventInterface);

        $booking_data = [];
        $booking_data['platform_user_id'] = auth()->user()->id;
        $booking_data['venue_id'] = $request->venue_id;
        $booking_data['event_id'] = $event->id;
        $this->bookingInterface->store('Booking', $booking_data);
        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $qr_tickets = Qrgenerate::where('event_id', $event->id)->get();
        if (!$qr_tickets) {
            return response()->json([
                'message' => 'There is no event for qr ticket!'
            ], 401);
        }
        $qrCodeImages = [];
        foreach ($qr_tickets as $key => $qr_ticket) {
            $qrCode = QrCode::size(150)->generate($qr_ticket);
            $qrCodeImages[$key] =  $qrCode;
        }

        response()->json([
            'message' => 'There is the event for qrCodeImages!',
            'qrTickets' => $qr_tickets,
            'qrCodeImages' => $qrCodeImages,
        ], 200);
        return view('home', compact('qrCodeImages', 'qr_tickets'));
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
    // public function update(EventRequest $request,Event $event)
    // {
       
    //     $validatedData = $request->validated();
    //     unset($validatedData['venue_id']);
    //     $event = $this->eventInterface->findByID('Event', $event->id);
    //     if (!$event) {
    //         return response()->json([
    //             'message' => 'Event not found'
    //         ], 401);
    //     }
    //     $event = $this->eventInterface->update('Event', $validatedData, $event->id);
    //     // $event->update($validatedData);
    //     return new EventResource($event);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // $status = $event->cascadingEvent($event->id) ?
        //     $event = $this->eventInterface->delete('Event', $event->id) : false;
        // $this->eventInterface->delete('Event', $event->id) ?
        //     response(status: 204) : response(status: 500);
        $event->forceDelete() ? response(status: 204) : response(status: 500);
       
//         $event = $this->eventInterface->delete('Event', $event->id);
//         $image = Image::where('link_id', $event->id)->where('genre', Config::get('variables.THREE'))->first();
//         $image ? $this->eventInterface->delete('Image', $image->id) : '';
//         return new EventResource($event);
    }
}
