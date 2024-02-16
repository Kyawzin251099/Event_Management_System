<?php

namespace App\Http\Controllers;

use App\Contracts\AddressInterface;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    private AddressInterface $addressInterface;
    public function __construct(AddressInterface $addressInterface)
    {
        $this->addressInterface = $addressInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = $this->addressInterface->all();
        return AddressResource::collection($addresses);
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
    public function store(AddressRequest $request)
    {

        $validatedData = $request->validated();
        //$address = Address::create($validatedData);
        $address = $this->addressInterface->store('Address', $validatedData);
        if (!$address) {
            return response()->json([
                'message' => 'Something wrong and please try again!'
            ], 401);
        }
        return new AddressResource($address);
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
    public function update(AddressRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $address = $this->addressInterface->findByID('Address', $id);
        if (!$address) {
            return response()->json([
                'message' => 'The address id not found!'
            ], 401);
        }
        //$address->update($validatedData);
        $address = $this->addressInterface->update('Address', $validatedData, $id);
        return new AddressResource($address);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = $this->addressInterface->findByID('Address', $id);
        if (!$address) {
            return response()->json([
                'message' => 'The address id not found!'
            ], 401);
        }
        //$address->delete();
        $address = $this->addressInterface->delete('Address', $id);
        return new AddressResource($address);
    }
}
