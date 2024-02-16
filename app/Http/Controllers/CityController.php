<?php

namespace App\Http\Controllers;

use App\Contracts\CityInterface;
use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private  $cityInterface;
    public function __construct(CityInterface $cityInterface)
    {
        $this->cityInterface = $cityInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $city = $this->cityInterface->all();
        return CityResource::collection($city);
        // $city = City::paginate(5);
        // return CityResource::collection($city);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $validatedData = $request->validated();
        $city = $this->cityInterface->store('City', $validatedData);
        if (!$city) {
            return response()->json(['message' => 'City creation failed.'], 400);
        }
        return new CityResource($city);
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
    public function update(CityRequest $request, int $id)
    {
        $validatedData = $request->validated();
        $city = $this->cityInterface->findByID('City', $id);

        //$city = City::find($id);
        if (!$city) {
            return response()->json([
                'message' => 'City is not found'
            ], 400);
        }
        $city = $this->cityInterface->update('City', $validatedData, $id);
        return new CityResource($city);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $city = $this->cityInterface->findByID('City', $id);
        // $city = City::find($id);
        if (!$city) {
            return response()->json([
                'message' => 'City can not Delete successfully'
            ], 400);
        }
        $city = $this->cityInterface->delete('City', $id);
        return new CityResource($city);
    }
}
