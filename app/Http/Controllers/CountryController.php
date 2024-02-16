<?php

namespace App\Http\Controllers;
use App\Http\Resources\CountryResource;
use Illuminate\Http\Request;
use App\Contracts\CountryInterface;
use App\Http\Requests\CountryRequest;
use App\Models\Country;


class CountryController extends Controller
{
    private CountryInterface $countryInterface;
    public function __construct(CountryInterface $countryInterface)
    {
        $this->countryInterface = $countryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $country = $this->countryInterface->all();
        return CountryResource::collection($country);
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
    public function store(CountryRequest $request)
    {
        $validatedData = $request->validated();
        $country = $this->countryInterface->store('Country' ,$validatedData);
        // $country = Country::create($validatedData);
        if(!$country){
            return response()->json([
                'message' => 'Country not found'
            ], 401);
        }
        return new CountryResource($country);
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
    public function update(CountryRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $country = $this->countryInterface->findByID('Country', $id);
        if(!$country){
            return response()->json([
                'message' => 'Country not found'
            ],401);
        }
        $country = $this->countryInterface->update('Country',$validatedData, $id);
        // $country->update($validatedData);
        return new CountryResource($country);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = $this->countryInterface->findByID('Country', $id);
        if(!$country){
            return response()->json([
                'message' => 'Country not found',
            ], 400);
        }
        $country = $this->countryInterface->delete('Country',$id);
        // $country->delete();
        return new CountryResource($country);
    }
}
