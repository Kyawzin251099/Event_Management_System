<?php

namespace App\Http\Controllers;

use App\Contracts\QrTicketInterface;
use App\Http\Requests\QrTicketRequest;
use App\Http\Resources\QrTicketResource;
use App\Models\Qrgenerate;
use App\Models\QrTicket;
use Illuminate\Http\Request;

class QrTicketController extends Controller
{
    private $qrTicketInterface;

    public function __construct(QrTicketInterface $qrTicketInterface)
    {
        $this->qrTicketInterface = $qrTicketInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $qr_tickets = $this->qrTicketInterface->all();
        // return QrTicketResource::collection($qr_tickets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(QrTicketRequest $request)
    {
        // return $this->adHoc_id;
        // Use $adHocId to perform your logic
        // For example, retrieve the AdHoc entity by ID and process it
        // $validatedData = $request->validated();
        // $ad_hoc_id = AdHoc::find($this->adHoc_id);


        // $validatedData['ad_hoc_id'] = $ad_hoc_id;
        // $randomBytes = random_bytes(16);
        // $validatedData['qr_code'] = bin2hex($randomBytes);

        // $qr_ticket = $this->qrTicketInterface->store($validatedData);

        // if (!$qr_ticket) {
        //     return response()->json([
        //         'message' => 'Failed to create Qr Code Ticket'
        //     ], 400);
        // }
        // return new QrTicketResource($qr_ticket);
    }







    /**
     * Store a newly created resource in storage.
     */
    // public function store($adHocId)
    // {

    //     //$validatedData = $request->validated();
    //     $adHoc = $event->adHoc; // Assuming you pass the AdHoc object as an event property

    //     $qrTickerController = new QrTickerController();
    //     $qrTickerController->processQrTicket($adHoc->id);


    //     $randomBytes = random_bytes(16);
    //     $validatedData['qr_code'] = bin2hex($randomBytes);

    //     $qr_ticket = $this->qrTicketInterface->store($validatedData);


    //     //$qr_ticket = QrTicket::create($validatedData);

    //     if (!$qr_ticket) {
    //         return response()->json([
    //             'message' => 'Failed to create Qr Code Ticket'
    //         ], 400);
    //     }
    //     return new QrTicketResource($qr_ticket);
    // }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
    public function update(QrTicketRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $qr_ticket = $this->qrTicketInterface->findByID('QrTicket', $id);

        // $qr_ticket = QrTicket::find($id);
        if (!$qr_ticket) {
            return response()->json([
                'message' => "Your Township is not found!",
            ], 400);
        }
        $qr_ticket = $this->qrTicketInterface->update('QrTicket', $validatedData, $id);

        // $qr_ticket->update($validatedData);
        return new QrTicketResource($qr_ticket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $qr_ticket = $this->qrTicketInterface->findByID('QrTicket', $id);

        //$qr_ticket = QrTicket::find($id);
        if (!$qr_ticket) {
            return response()->json([
                'message' => 'Qr Ticket is not Found and Failed to Delete'
            ], 400);
        }
        //$township = $this->townshipInterface->delete($id);
        $qr_ticket = $this->qrTicketInterface->delete('QrTicket', $id);
        // $qr_ticket->delete();
        return new QrTicketResource($qr_ticket);
    }
}
