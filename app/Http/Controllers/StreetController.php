<?php

namespace App\Http\Controllers;

use App\Contracts\StreetInterface;
use App\Http\Requests\StreetRequest;
use App\Http\Resources\StreetResource;
use App\Models\Street;

class StreetController extends Controller
{
    //private StreetInterface $streetInterface;
    public function __construct(private StreetInterface $streetInterface)
    {
        $this->streetInterface = $streetInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $streets = $this->streetInterface->all();
        return StreetResource::collection($streets);
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
    public function store(StreetRequest $request)
    {
        $validatedData = $request->validated();
        //$street = Street::create($validatedData);
        $street = $this->streetInterface->store('Street', $validatedData);
        if (!$street) {
            return response()->json([
                'message' => 'Something wrong and please try again!',
            ], 401);
        }
        return new StreetResource($street);
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
    public function update(StreetRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $street = $this->streetInterface->findByID('Street', $id);
        if (!$street) {
            return response()->json([
                'message' => 'The street id not found!',
            ], 400);
        }
        //$street->update($validatedData);
        $street = $this->streetInterface->update('Street', $validatedData, $id);
        return new StreetResource($street);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $street = $this->streetInterface->findByID('Street', $id);
        if (!$street) {
            return response()->json([
                'message' => 'The street id not found!',
            ], 400);
        }
        //$street->delete();
        $street = $this->streetInterface->delete('Street', $id);
        return new StreetResource($street);
    }
}
