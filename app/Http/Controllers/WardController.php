<?php

namespace App\Http\Controllers;

use App\Contracts\WardInterface;
use App\Http\Requests\WardRequest;
use App\Http\Resources\WardResource;
use App\Models\Ward;
use Illuminate\Http\Request;

class WardController extends Controller
{
    //private WardInterface $wardInterface;
    public function __construct(private WardInterface $wardInterface)
    {
        $this->wardInterface = $wardInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wards = $this->wardInterface->all();
        return WardResource::collection($wards);
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
    public function store(WardRequest $request)
    {
        $validatedData = $request->validated();
        //$ward = Ward::create($validatedData);
        $ward = $this->wardInterface->store('Ward', $validatedData);
        if (!$ward) {
            return response()->json([
                'message' => 'Something wrong and please try again!',
            ], 400);
        }
        return new WardResource($ward);
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
    public function update(WardRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $ward = $this->wardInterface->findByID('Ward', $id);
        if (!$ward) {
            return response()->json([
                'message' => 'The ward id is not found!',
            ], 400);
        }
        //$ward->update($validatedData);
        $ward = $this->wardInterface->update('Ward', $validatedData, $id);
        return new WardResource($ward);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ward = $this->wardInterface->findByID('Ward', $id);
        if (!$ward) {
            return response()->json([
                'message' => 'The ward name not found!',
            ], 400);
        }
        //$ward->delete();
        $ward = $this->wardInterface->delete('Ward', $id);
        return new WardResource($ward);
    }
}
