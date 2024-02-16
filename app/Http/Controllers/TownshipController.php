<?php

namespace App\Http\Controllers;

use App\Contracts\TownshipInterface;
use App\Http\Requests\TownshipRequest;
use App\Http\Resources\TownshipResource;
use App\Models\Township;

class TownshipController extends Controller
{
    // private TownshipInterface $townshipInterface;
    public function __construct(private TownshipInterface $townshipInterface)
    {
        $this->townshipInterface = $townshipInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $township = $this->townshipInterface->all();
        return TownshipResource::collection($township);
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
    public function store(TownshipRequest $request)
    {
        $validatedData = $request->validated();
        $township = $this->townshipInterface->store('Township', $validatedData);
        // $township = Township::create($validatedData);
        //$return_data = new TownshipResource($township);
        if (!$township) {
            return response()->json([
                'message' => 'Failed to create township',
            ], 400);
        }
        return new TownshipResource($township);
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


    public function update(TownshipRequest $request, $id)
    {
        $validatedData = $request->validated();
        $township = $this->townshipInterface->findByID('Township', $id);
        // $township = Township::find($id);
        if (!$township) {
            return response()->json([
                'message' => 'Township is not Found!',
            ], 400);
        }
        $township = $this->townshipInterface->update('Township', $validatedData, $id);
        // $township->update($validatedData);
        return new TownshipResource($township);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $township = $this->townshipInterface->findByID('Township', $id);

        // $township = Township::find($id);
        if (!$township) {
            return response()->json([
                'message' => 'Township not found'
            ], 404);
        }
        $township = $this->townshipInterface->delete('Township', $id);
        //$township->delete();
        return new TownshipResource($township);
    }
}


//Draft!!

/**
 * Update the specified resource in storage.
 */
    // public function update(TownshipRequest $request, $id)
    // {
    //     $validatedData = $request->validated();


    //     $township = Township::find($id);



    //     $township->update([
    //         'name' => $validatedData['name'],
    //         'city_id' => $validatedData['city_id']
    //     ]);

    //     if ($township) {
    //          return response()->json([
    //             'township' => $township,
    //             'message' => 'Township is Updated Successfully',
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'message' => 'Failed to update township',
    //         ], 400);
    //     }
    // }
