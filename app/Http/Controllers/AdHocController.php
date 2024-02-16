<?php

namespace App\Http\Controllers;

use App\Contracts\AdHocInterface;
use App\Contracts\QrTicketInterface;
use App\Http\Requests\AdHocRequest;
use App\Http\Controllers\QrTickerController;
use App\Http\Resources\AdHocResource;
use App\Listeners\ProcessAdHocStored;
use App\Models\AdHoc;
use App\Models\QrTicket;

class AdHocController extends Controller
{
    private $adHocInterface;
    private $qrTicketInterface;

    public function __construct(AdHocInterface $adHocInterface, QrTicketInterface $qrTicketInterface)
    {
        $this->adHocInterface = $adHocInterface;
        $this->qrTicketInterface = $qrTicketInterface;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adHoc = $this->adHocInterface->all();
        return AdHocResource::collection($adHoc);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function store(AdHocRequest $request)
    {
        $validatedData = $request->validated();
        $adHoc = $this->adHocInterface->store('AdHoc',$validatedData);

        if (!$adHoc) {
            return response()->json([
                'message' => 'Something went wring and please try again.'
            ], 400);
        } else {
            $qrTicket = [];
            $qrTicket['ad_hoc_id'] = $adHoc->id;
            $qrTicket['qr_code'] = rand();
            $qrTicket = $this->qrTicketInterface->store("QrTicket",$qrTicket);
        }
        return new AdHocResource($adHoc);
    }




    /**
     * Store a newly created resource in storage.
     */
    // public function store(AdHocRequest $request, QrTicketController $qrTicketController)
    // {
    //     $validatedData = $request->validated();
    //     $adHoc = $this->adHocInterface->store($validatedData);
    //     if (!$adHoc) {
    //         return response()->json(['message' => 'City creation failed.'], 400);
    //     }
    //    // event(new AdHocStored($adHoc));
    //     event(new ProcessAdHocStored($adHoc));
    //     return new AdHocResource($adHoc);


    // if (!AdHoc::create($request->validated())) {
    //     return response()->json([
    //         'message' => 'AdHoc not Found'
    //     ]);
    // }
    // return new AdHocResource(AdHoc::create($request->validated()));    }

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
    public function update(AdHocRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $adHoc = $this->adHocInterface->findByID('AdHoc', $id);
        if (!$adHoc) {
            return response()->json([
                'message' => 'City is not found'
            ], 400);
        }
        $adHoc = $this->adHocInterface->update('AdHoc',$validatedData, $id);

        return new AdHocResource($adHoc);
        // if (!AdHoc::find($id)) {
        //     return response()->json([
        //         'message' => 'AdHoc is not Updated'
        //     ]);
        // }
        // AdHoc::find($id)->update($request->validated());
        // return new AdHocResource(AdHoc::find($id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $adHoc = $this->adHocInterface->findByID('AdHoc', $id);
        if (!$adHoc) {
            return response()->json([
                'message' => 'AdHoc can not Delete successfully'
            ], 400);
        }

        if ($this->adHocInterface->delete('AdHoc',$id)) {
            $qr_ticket = QrTicket::where('id', $adHoc->id)->first();
            //$this->qrTicketInterface->delete($qr_ticket->id);
            $this->qrTicketInterface->delete("QrTicket",$qr_ticket->id);
            return new AdHocResource($adHoc);
        }
        return response(['message' => 'error']);
    }
}
